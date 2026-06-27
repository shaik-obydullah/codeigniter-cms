<?php
namespace App\Controllers;

use App\Models\CashbookModel;
use App\Models\ActivityModel;
use App\Models\ConfigurationModel;

class CashbookController extends BaseController
{
    protected $cashbookModel;
    protected $activityModel;
    protected $configModel;

    public function __construct()
    {
        $this->cashbookModel = new CashbookModel();
        $this->activityModel = new ActivityModel();
        $this->configModel = new ConfigurationModel();
    }

    public function index()
    {
        $configList = $this->configModel->getAllConfigs();

        $data = [
            'title' => 'Cashbook Management',
            'date_format' => $configList['date_format'],
            'paginate_rows' => $configList['paginate_rows'],
        ];

        $data['content'] = view('cashbook/index', $data);
        return view('dashboard/master', $data);
    }

    public function list()
    {
        $configList = $this->configModel->getAllConfigs();

        $perPage = (int) $configList['paginate_rows'];
        $page = $this->request->getGet('page') ?? 1;
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        $builder = $this->cashbookModel
            ->select('id, created_at, in_amount, out_amount')
            ->where('deleted_at', null);

        if (!empty($startDate)) {
            $builder->where('created_at >=', $startDate);
        }

        if (!empty($endDate)) {
            $builder->where('created_at <=', $endDate . ' 23:59:59');
        }

        $offset = ($page - 1) * $perPage;
        $cashbooks = $builder->orderBy('created_at', 'DESC')
            ->limit($perPage, $offset)
            ->findAll();

        $totalRecords = $this->cashbookModel->countAll();

        $filteredBuilder = clone $builder;
        $filteredCount = $filteredBuilder->countAllResults(false);

        foreach ($cashbooks as $i => $row) {
            $cashbooks[$i]['created_at'] = date($configList['date_format'], strtotime($row['created_at']));
        }

        $hasMore = ($offset + $perPage) < $filteredCount;

        return $this->response->setJSON([
            'success' => true,
            'data' => $cashbooks,
            'total_records' => $totalRecords,
            'filtered_count' => $filteredCount,
            'has_more' => $hasMore,
            'csrf_token' => csrf_hash()
        ]);
    }
}