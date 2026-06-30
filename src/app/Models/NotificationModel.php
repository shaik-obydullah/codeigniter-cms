<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table         = 'notifications';
    protected $primaryKey    = 'id';
    protected $returnType    = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = ['user_id', 'type', 'title', 'message', 'link', 'is_read'];

    public function unreadCount(int $userId): int
    {
        return $this->where('user_id', $userId)->where('is_read', 0)->countAllResults();
    }

    public function markAsRead(int $id, int $userId): bool
    {
        return $this->set('is_read', 1)->where('id', $id)->where('user_id', $userId)->update();
    }

    public function markAllAsRead(int $userId): bool
    {
        return $this->set('is_read', 1)->where('user_id', $userId)->where('is_read', 0)->update();
    }

    public function forUser(int $userId, int $perPage = 15)
    {
        return $this->where('user_id', $userId)->orderBy('created_at', 'DESC')->paginate($perPage);
    }
}
