<?php

namespace App\Controllers\Admin;

use App\Models\ActivityModel;
use App\Models\NotificationModel;

class BaseController extends \App\Controllers\BaseController
{
    protected $notificationModel;
    protected $activityModel;

    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);

        $this->notificationModel = model(NotificationModel::class);
        $this->activityModel     = model(ActivityModel::class);
    }

    protected function adminView(string $view, array $data = []): string
    {
        $user = auth()->user();

        $data = array_merge([
            'user'              => $user,
            'unreadCount'       => $this->notificationModel->unreadCount($user->id),
            'pageTitle'         => 'Dashboard',
        ], $data);

        return view('admin/' . $view, $data);
    }
}
