<?php
namespace App\Controllers;

use App\Models\ExpenseModel;
use App\Models\CashbookModel;
use App\Models\WalletModel;
use App\Models\ActivityModel;
use App\Models\ConfigurationModel;

class ExpenseController extends BaseController
{
    protected $expenseModel;
    protected $cashbookModel;
    protected $walletModel;
    protected $activityModel;
    protected $configModel;

    public function __construct()
    {
        $this->expenseModel = new ExpenseModel();
        $this->cashbookModel = new CashbookModel();
        $this->walletModel = new WalletModel();
        $this->activityModel = new ActivityModel();
        $this->configModel = new ConfigurationModel();
    }

    public function index()
    {
        $wallets = $this->walletModel->where('category', 'expense')->findAll();
        $configList = $this->configModel->getAllConfigs();

        $data = [
            'title' => 'Expense Management',
            'currencies' => $configList['currencies'],
            'wallets' => $wallets,
            'date_format' => $configList['date_format'],
            'paginate_rows' => $configList['paginate_rows'],
        ];

        $data['content'] = view('expense/index', $data);
        return view('dashboard/master', $data);
    }

    public function list()
    {
        $configList = $this->configModel->getAllConfigs();

        $perPage = (int) $configList['paginate_rows'];
        $page = $this->request->getGet('page') ?? 1;
        $search = $this->request->getGet('search');
        $walletId = $this->request->getGet('wallet_id');
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        $builder = $this->expenseModel
            ->select('expenses.id, expenses.created_at, expenses.description, expenses.amount, expenses.currency, wallets.name as wallet_name')
            ->join('wallets', 'wallets.id = expenses.fk_wallet_id', 'left')
            ->where('expenses.deleted_at', null);

        if (!empty($search)) {
            $builder->groupStart()
                ->like('expenses.description', $search)
                ->groupEnd();
        }

        if (!empty($walletId)) {
            $builder->where('expenses.fk_wallet_id', $walletId);
        }

        if (!empty($startDate)) {
            $builder->where('expenses.created_at >=', $startDate);
        }

        if (!empty($endDate)) {
            $builder->where('expenses.created_at <=', $endDate . ' 23:59:59');
        }

        $offset = ($page - 1) * $perPage;
        $expenses = $builder->orderBy('expenses.created_at', 'DESC')
            ->limit($perPage, $offset)
            ->findAll();

        $totalRecords = $this->expenseModel->countAll();

        $filteredBuilder = clone $builder;
        $filteredCount = $filteredBuilder->countAllResults(false);

        foreach ($expenses as $i => $row) {
            $expenses[$i]['created_at'] = date($configList['date_format'], strtotime($row['created_at']));
        }

        $hasMore = ($offset + $perPage) < $filteredCount;

        return $this->response->setJSON([
            'success' => true,
            'data' => $expenses,
            'total_records' => $totalRecords,
            'filtered_count' => $filteredCount,
            'has_more' => $hasMore,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function create()
    {
        $currency = (string) $this->request->getPost('currency');
        $selectCurrency = empty($currency) ? '£' : $currency;
    
        $created_at = (string) $this->request->getPost('date');
        $selectDate = empty($created_at) ? current_datetime() : $created_at . ' ' . date('H:i:s');
    
        $data = [
            'fk_wallet_id' => $this->request->getPost('wallet_id'),
            'currency' => $selectCurrency,
            'amount' => $this->request->getPost('amount'),
            'created_at' => $selectDate,
            'description' => $this->request->getPost('description'),
        ];
    
        $db = \Config\Database::connect();
        $db->transStart();
    
        if (!$this->expenseModel->insert($data)) {
            $db->transRollback();
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => $this->expenseModel->errors(),
                    'csrf_token' => csrf_hash()
                ]);
        }
    
        $insertId = $this->expenseModel->getInsertID();
    
        $cashbookData = [
            'fk_reference_id' => $insertId,
            'out_amount' => $data['amount'],
            'created_at' => $selectDate,
        ];
        $this->cashbookModel->insert($cashbookData);
    
        $newIncome = $this->expenseModel->find($insertId);
    
        $this->activityModel->logActivity('success', $data['description'] . ' Income Created');
    
        $db->transComplete();
    
        return $this->response->setJSON([
            'success' => true,
            'expense' => $newIncome,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function select($id)
    {
        $expense = $this->expenseModel->find($id);
        if (!$expense) {
            return $this->response->setStatusCode(404)->setJSON([
                'success' => false,
                'message' => 'Expense not found',
                'csrf_token' => csrf_hash()
            ]);
        }

        $dateTime = $expense['created_at'];
        $dateOnly = date('Y-m-d', strtotime($dateTime));

        return $this->response->setJSON([
            'success' => true,
            'data' => $expense,
            'dateOnly' => $dateOnly,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function update($id)
    {
        $created_at = (string) $this->request->getPost('date');
        $selectDate = empty($created_at) ? current_datetime() : $created_at . ' ' . date('H:i:s');
    
        $data = [
            'fk_wallet_id' => $this->request->getPost('wallet_id'),
            'currency' => (string) $this->request->getPost('currency'),
            'amount' => $this->request->getPost('amount'),
            'created_at' => $selectDate,
            'description' => $this->request->getPost('description'),
        ];
    
        $db = \Config\Database::connect();
        $db->transStart();
    
        if (!$this->expenseModel->update($id, $data)) {
            $db->transRollback();
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => $this->expenseModel->errors(),
                    'csrf_token' => csrf_hash()
                ]);
        }
    
        try {
            $this->cashbookModel
                ->where('fk_reference_id', $id)
                ->set([
                    'out_amount' => $data['amount'],
                    'updated_at' => $selectDate,
                ])
                ->update();
    
            $updatedIncome = $this->expenseModel->find($id);
    
            $this->activityModel->logActivity('warning', $updatedIncome['description'] . ' Income Updated');
    
            $db->transComplete();
    
            return $this->response->setJSON([
                'success' => true,
                'wallet' => $updatedIncome,
                'csrf_token' => csrf_hash()
            ]);
    
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'error' => 'Failed to update expense or cashbook',
                'csrf_token' => csrf_hash()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $expense = $this->expenseModel->find($id);
            if (!$expense) {
                return $this->response->setStatusCode(404)->setJSON([
                    'success' => false,
                    'message' => 'Expense not found',
                    'csrf_token' => csrf_hash()
                ]);
            }

            $this->expenseModel->delete($id);

            $this->activityModel->logActivity('warning', $expense['description'] . ' Expense Deleted');

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Expense deleted successfully',
                'csrf_token' => csrf_hash()
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'error' => 'Failed to delete expense',
                'csrf_token' => csrf_hash()
            ]);
        }
    }
}