<?php

namespace App\Controllers\Admin;

use App\Models\ActivityModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $totalUsers    = model('UserModel')->countAllResults();
        $pendingComments = $this->activityModel->where('type', 'comment')->countAllResults();
        $recentActivity  = $this->activityModel->orderBy('created_at', 'DESC')->findAll(5);

        return $this->adminView('dashboard', [
            'pageTitle'      => 'Dashboard',
            'totalUsers'     => $totalUsers,
            'pendingComments' => $pendingComments,
            'recentActivity'  => $recentActivity,
        ]);
    }
}
