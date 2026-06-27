<?php
namespace App\Controllers;

use App\Models\IncomeModel;
use App\Models\CashbookModel;
use App\Models\WalletModel;
use App\Models\ActivityModel;
use App\Models\ConfigurationModel;

class IncomeController extends BaseController
{
    protected $incomeModel;
    protected $cashbookModel;
    protected $walletModel;
    protected $activityModel;
    protected $configModel;

    public function __construct()
    {
        $this->incomeModel = new IncomeModel();
        $this->cashbookModel = new CashbookModel();
        $this->walletModel = new WalletModel();
        $this->activityModel = new ActivityModel();
        $this->configModel = new ConfigurationModel();
    }

    public function index()
    {
        $wallets = $this->walletModel->where('category', 'income')->findAll();
        $configList = $this->configModel->getAllConfigs();

        $data = [
            'title' => 'Income Management',
            'currencies' => $configList['currencies'],
            'wallets' => $wallets,
            'date_format' => $configList['date_format'],
            'paginate_rows' => $configList['paginate_rows'],
        ];

        $data['content'] = view('income/index', $data);
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

        $builder = $this->incomeModel
            ->select('incomes.id, incomes.created_at, incomes.description, incomes.amount, incomes.currency, wallets.name as wallet_name')
            ->join('wallets', 'wallets.id = incomes.fk_wallet_id', 'left')
            ->where('incomes.deleted_at', null);

        if (!empty($search)) {
            $builder->groupStart()
                ->like('incomes.description', $search)
                ->groupEnd();
        }

        if (!empty($walletId)) {
            $builder->where('incomes.fk_wallet_id', $walletId);
        }

        if (!empty($startDate)) {
            $builder->where('incomes.created_at >=', $startDate);
        }

        if (!empty($endDate)) {
            $builder->where('incomes.created_at <=', $endDate . ' 23:59:59');
        }

        $offset = ($page - 1) * $perPage;
        $incomes = $builder->orderBy('incomes.created_at', 'DESC')
            ->limit($perPage, $offset)
            ->findAll();

        $totalRecords = $this->incomeModel->countAll();

        $filteredBuilder = clone $builder;
        $filteredCount = $filteredBuilder->countAllResults(false);

        foreach ($incomes as $i => $row) {
            $incomes[$i]['created_at'] = date($configList['date_format'], strtotime($row['created_at']));
        }

        $hasMore = ($offset + $perPage) < $filteredCount;

        return $this->response->setJSON([
            'success' => true,
            'data' => $incomes,
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
    
        if (!$this->incomeModel->insert($data)) {
            $db->transRollback();
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => $this->incomeModel->errors(),
                    'csrf_token' => csrf_hash()
                ]);
        }
    
        $insertId = $this->incomeModel->getInsertID();
    
        $cashbookData = [
            'fk_reference_id' => $insertId,
            'in_amount' => $data['amount'],
            'created_at' => $selectDate,
        ];
        $this->cashbookModel->insert($cashbookData);
    
        $newIncome = $this->incomeModel->find($insertId);
    
        $this->activityModel->logActivity('success', $data['description'] . ' Income Created');
    
        $db->transComplete();
    
        return $this->response->setJSON([
            'success' => true,
            'income' => $newIncome,
            'csrf_token' => csrf_hash()
        ]);
    }
    
    public function select($id)
    {
        $income = $this->incomeModel->find($id);
        if (!$income) {
            return $this->response->setStatusCode(404)->setJSON([
                'success' => false,
                'message' => 'Income not found',
                'csrf_token' => csrf_hash()
            ]);
        }

        $dateTime = $income['created_at'];
        $dateOnly = date('Y-m-d', strtotime($dateTime));

        return $this->response->setJSON([
            'success' => true,
            'data' => $income,
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
    
        if (!$this->incomeModel->update($id, $data)) {
            $db->transRollback();
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => $this->incomeModel->errors(),
                    'csrf_token' => csrf_hash()
                ]);
        }
    
        try {
            $this->cashbookModel
                ->where('fk_reference_id', $id)
                ->set([
                    'in_amount' => $data['amount'],
                    'updated_at' => $selectDate,
                ])
                ->update();
    
            $updatedIncome = $this->incomeModel->find($id);
    
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
                'error' => 'Failed to update income or cashbook',
                'csrf_token' => csrf_hash()
            ]);
        }
    }
    
    public function delete($id)
    {
        try {
            $income = $this->incomeModel->find($id);
            if (!$income) {
                return $this->response->setStatusCode(404)->setJSON([
                    'success' => false,
                    'message' => 'Income not found',
                    'csrf_token' => csrf_hash()
                ]);
            }

            $this->incomeModel->delete($id);

            $this->activityModel->logActivity('warning', $income['description'] . ' Income Deleted');

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Income deleted successfully',
                'csrf_token' => csrf_hash()
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'error' => 'Failed to delete income',
                'csrf_token' => csrf_hash()
            ]);
        }
    }
}