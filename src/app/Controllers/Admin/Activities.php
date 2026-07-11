<?php

namespace App\Controllers\Admin;

class Activities extends BaseController
{
    public function index()
    {
        $activities = $this->activityModel->getAll();

        return $this->adminView('activities', [
            'pageTitle'  => 'Activities',
            'activities' => $activities,
            'pager'      => $this->activityModel->pager,
        ]);
    }
}
