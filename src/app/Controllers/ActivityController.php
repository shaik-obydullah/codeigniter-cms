<?php
namespace App\Controllers;

use App\Models\ActivityModel;
use App\Models\ConfigurationModel;

class ActivityController extends BaseController
{
    protected $activityModel;
    protected $configModel;

    public function __construct()
    {
        $this->activityModel = new ActivityModel();
        $this->configModel = new ConfigurationModel();
    }

    public function index()
    {
        $configList = $this->configModel->getAllConfigs();

        $data = [
            'title' => 'Activity Management',
            'date_format' => $configList['date_format'],
            'paginate_rows' => $configList['paginate_rows'],
        ];

        $data['content'] = view('activity/index', $data);
        return view('dashboard/master', $data);
    }

    public function list()
    {
        $configList = $this->configModel->getAllConfigs();

        $perPage = (int) $configList['paginate_rows'];
        $page = $this->request->getGet('page') ?? 1;
        $ipAddress = $this->request->getGet('ip_address');
        $visitorCountry = $this->request->getGet('visitor_country');
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        $builder = $this->activityModel->where('activities.deleted_at', null);

        if (!empty($ipAddress)) {
            $builder->groupStart()
                ->like('activities.ip_address', $ipAddress)
                ->groupEnd();
        }

        if (!empty($visitorCountry)) {
            $builder->groupStart()
                ->like('activities.visitor_country', $visitorCountry)
                ->groupEnd();
        }

        if (!empty($startDate)) {
            $builder->where('activities.created_at >=', $startDate);
        }

        if (!empty($endDate)) {
            $builder->where('activities.created_at <=', $endDate . ' 23:59:59');
        }

        $builder->join('admins', 'admins.id = activities.fk_admin_id', 'left')
            ->select('activities.*, admins.user_name as admin_name');

        $offset = ($page - 1) * $perPage;
        $activities = $builder->orderBy('activities.created_at', 'DESC')
            ->limit($perPage, $offset)
            ->findAll();

        $totalRecords = $this->activityModel->countAll();

        $filteredBuilder = clone $builder;
        $filteredCount = $filteredBuilder->countAllResults(false);

        foreach ($activities as $i => $row) {
            $activities[$i]['created_at'] = date($configList['date_format'], strtotime($row['created_at']));
        }

        $hasMore = ($offset + $perPage) < $filteredCount;

        return $this->response->setJSON([
            'success' => true,
            'data' => $activities,
            'total_records' => $totalRecords,
            'filtered_count' => $filteredCount,
            'has_more' => $hasMore,
            'csrf_token' => csrf_hash()
        ]);
    }
}