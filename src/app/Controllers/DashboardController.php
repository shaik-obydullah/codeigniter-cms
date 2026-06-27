<?php

namespace App\Controllers;

use App\Models\ActivityModel;
use App\Models\ConfigurationModel;
use App\Models\MessageModel;

class DashboardController extends BaseController
{
    protected $activityModel;
    protected $configModel;
    protected $messageModel;

    public function __construct()
    {
        $this->activityModel = new ActivityModel();
        $this->configModel = new ConfigurationModel();
        $this->messageModel = new MessageModel();
    }

    public function index()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();

        $now = new \DateTime();
        $month = $now->format('m');
        $year = $now->format('Y');
        $start = "$year-$month-01";
        $end = "$year-$month-31";

        $dashboardData = $this->getDashboardData($db, $start, $end);

        $recentMessageCount = $this->messageModel
            ->where('status', 'unseen')
            ->countAllResults();

        session()->set('recentMessageCount', $recentMessageCount);

        $data = [
            'title' => 'Dashboard',
            'dashboardData' => $dashboardData,
            'chartData' => [
                'incomeCategories' => array_column($dashboardData['walletIncomes'], 'wallet_name'),
                'incomeAmounts' => array_column($dashboardData['walletIncomes'], 'total_income'),
                'expenseCategories' => array_column($dashboardData['walletExpenses'], 'wallet_name'),
                'expenseAmounts' => array_column($dashboardData['walletExpenses'], 'total_expense')
            ]
        ];
        $data['content'] = view('dashboard/index', $data);
        return view('dashboard/master', $data);
    }
    protected function getDashboardData($db, $start, $end)
    {
        $inQuery = $db->query(
            "SELECT COALESCE(SUM(in_amount), 0) AS total_in FROM cashbook
             WHERE created_at BETWEEN ? AND ? AND deleted_at IS NULL",
            [$start, $end]
        );
        $inResult = $inQuery->getRow();

        $outQuery = $db->query(
            "SELECT COALESCE(SUM(out_amount), 0) AS total_out FROM cashbook
             WHERE created_at BETWEEN ? AND ? AND deleted_at IS NULL",
            [$start, $end]
        );
        $outResult = $outQuery->getRow();

        $walletExpenseQuery = $db->query(
            "SELECT w.name AS wallet_name, 
                    COALESCE(SUM(e.amount), 0) AS total_expense
             FROM expenses e
             LEFT JOIN wallets w ON e.fk_wallet_id = w.id
             WHERE e.created_at BETWEEN ? AND ? 
               AND e.deleted_at IS NULL
             GROUP BY w.name",
            [$start, $end]
        );
        $walletExpenses = $walletExpenseQuery->getResultArray();

        $walletIncomeQuery = $db->query(
            "SELECT w.name AS wallet_name, 
                    COALESCE(SUM(i.amount), 0) AS total_income
             FROM incomes i
             LEFT JOIN wallets w ON i.fk_wallet_id = w.id
             WHERE i.created_at BETWEEN ? AND ? 
               AND i.deleted_at IS NULL
             GROUP BY w.name",
            [$start, $end]
        );
        $walletIncomes = $walletIncomeQuery->getResultArray();

        return [
            'in' => (float) $inResult->total_in,
            'out' => (float) $outResult->total_out,
            'balance' => (float) $inResult->total_in - (float) $outResult->total_out,
            'walletExpenses' => $walletExpenses,
            'walletIncomes' => $walletIncomes
        ];
    }

    public function setting()
    {
        $data = [
            'title' => 'Settings',
        ];
        $data['content'] = view('dashboard/setting', $data);
        return view('dashboard/master', $data);
    }

    public function get_setting()
    {
        $rows = $this->configModel->findAll();

        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['name']] = $row['setting'];
        }

        return $this->response->setJSON($settings);
    }

    public function save_setting()
    {
        $rawInput = $this->request->getBody();
        $settings = json_decode($rawInput, true);

        if (!$settings) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Invalid JSON payload',
                'csrf_token' => csrf_hash()
            ]);
        }

        if (isset($settings['currencies']) && is_array($settings['currencies'])) {
            $settings['currencies'] = json_encode($settings['currencies']);
        }

        $db = \Config\Database::connect();
        $builder = $db->table('configurations');

        try {
            foreach ($settings as $name => $value) {
                $builder->where('name', $name)->update(['setting' => $value]);
            }

            $this->configModel->clearConfigCache();
            $this->activityModel->logActivity('warning', 'Configuration Changed');

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Settings saved successfully.',
                'csrf_token' => csrf_hash()
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'error' => 'Failed to update configuration',
                'csrf_token' => csrf_hash()
            ]);
        }
    }
}