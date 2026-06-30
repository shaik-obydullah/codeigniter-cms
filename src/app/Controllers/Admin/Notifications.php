<?php

namespace App\Controllers\Admin;

class Notifications extends BaseController
{
    public function index()
    {
        $notifications = $this->notificationModel->forUser(auth()->id());

        return $this->adminView('notifications', [
            'pageTitle'     => 'Notifications',
            'notifications' => $notifications,
            'pager'         => $this->notificationModel->pager,
        ]);
    }

    public function markRead(int $id)
    {
        $this->notificationModel->markAsRead($id, auth()->id());
        return redirect()->back();
    }

    public function markAllRead()
    {
        $this->notificationModel->markAllAsRead(auth()->id());
        return redirect()->back()->with('message', 'All notifications marked as read.');
    }

    public function unreadCount()
    {
        return $this->response->setJSON([
            'count' => $this->notificationModel->unreadCount(auth()->id()),
        ]);
    }
}
