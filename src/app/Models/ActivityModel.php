<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table         = 'activities';
    protected $primaryKey    = 'id';
    protected $returnType    = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = ['user_id', 'type', 'description', 'target_type', 'target_id'];

    public function getAll(int $perPage = 20)
    {
        return $this->orderBy('created_at', 'DESC')->paginate($perPage);
    }

    public function log(int $userId, string $type, string $description, ?string $targetType = null, ?int $targetId = null): void
    {
        $this->insert([
            'user_id'     => $userId,
            'type'        => $type,
            'description' => $description,
            'target_type' => $targetType,
            'target_id'   => $targetId,
        ]);
    }
}
