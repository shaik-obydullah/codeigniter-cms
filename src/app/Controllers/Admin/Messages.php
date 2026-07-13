<?php

namespace App\Controllers\Admin;

use App\Models\MessagesModel;

class Messages extends BaseController
{
    public function index()
    {
        $model   = model(MessagesModel::class);
        $isRead  = $this->request->getGet('status');

        $model->orderBy('created_at', 'DESC');

        if ($isRead === 'unread') {
            $model->where('is_read', 0);
        } elseif ($isRead === 'read') {
            $model->where('is_read', 1);
        }

        $messages = $model->paginate(20);
        $pager    = $model->pager;

        return $this->adminView('messages', [
            'pageTitle' => 'Messages',
            'messages'  => $messages,
            'pager'     => $pager,
            'isRead'    => $isRead,
            'unreadCount' => $this->notificationModel->unreadCount(auth()->id()),
        ]);
    }

    public function edit(int $id)
    {
        $model   = model(MessagesModel::class);
        $message = $model->find($id);

        if (!$message) {
            return redirect()->to('/dashboard/messages')->with('error', 'Message not found.');
        }

        if (!$message->is_read) {
            $model->update($id, ['is_read' => 1]);
            $message->is_read = 1;
        }

        return $this->adminView('message-edit', [
            'pageTitle' => 'View Message',
            'message'   => $message,
            'unreadCount' => $this->notificationModel->unreadCount(auth()->id()),
        ]);
    }

    public function update(int $id)
    {
        $model   = model(MessagesModel::class);
        $message = $model->find($id);

        if (!$message) {
            return redirect()->to('/dashboard/messages')->with('error', 'Message not found.');
        }

        $isRead = $this->request->getPost('is_read') ? 1 : 0;
        $model->update($id, ['is_read' => $isRead]);

        $this->activityModel->log(
            auth()->id(),
            'message.updated',
            'Updated message #' . $id,
            'messages',
            $id
        );

        return redirect()->to('/dashboard/messages/' . $id . '/edit')->with('message', 'Message updated.');
    }

    public function delete(int $id)
    {
        $model   = model(MessagesModel::class);
        $message = $model->find($id);

        if (!$message) {
            return redirect()->back()->with('error', 'Message not found.');
        }

        $model->delete($id);

        $this->activityModel->log(
            auth()->id(),
            'message.deleted',
            'Deleted message from ' . $message->name,
            'messages',
            $id
        );

        return redirect()->to('/dashboard/messages')->with('message', 'Message deleted successfully.');
    }
}
