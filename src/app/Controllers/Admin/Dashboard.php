<?php

namespace App\Controllers\Admin;

use App\Models\ActivityModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $totalUsers      = model('UserModel')->countAllResults();
        $totalArticles   = model('ArticleModel')->countAllResults();
        $totalProjects   = model('ProjectModel')->countAllResults();
        $totalSkills     = model('SkillModel')->countAllResults();
        $pendingComments = $this->activityModel->where('type', 'comment')->countAllResults();
        $recentActivity  = $this->activityModel->orderBy('created_at', 'DESC')->findAll(5);

        return $this->adminView('dashboard', [
            'pageTitle'       => 'Dashboard',
            'totalUsers'      => $totalUsers,
            'totalArticles'   => $totalArticles,
            'totalProjects'   => $totalProjects,
            'totalSkills'     => $totalSkills,
            'pendingComments' => $pendingComments,
            'recentActivity'  => $recentActivity,
        ]);
    }
}
