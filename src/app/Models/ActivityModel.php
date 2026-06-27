<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table = 'activities';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'fk_admin_id',
        'type',
        'name',
        'ip_address',
        'visitor_country',
        'visitor_state',
        'visitor_city',
        'visitor_address',
        'created_at',
        'created_by',
        'deleted_at'
    ];

    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';
    protected $useTimestamps = false;
    protected $beforeInsert = ['setTimestamps', 'addIpInfo'];

    protected array $casts = [
        'id' => 'int',
        'fk_admin_id' => '?int',
        'created_by' => '?int'
    ];
    
    protected $validationRules = [
        'type' => 'required|trim|in_list[success,warning,error]',
        'name' => 'required|max_length[150]'
    ];

    protected function setTimestamps(array $data): array
    {
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    protected function addIpInfo(array $data): array
    {
        $request = service('request');
        $ip = $request->getIPAddress();
        
        $data['data']['ip_address'] = $ip;
        
        if (function_exists('ip_info')) {
            $ipInfo = ip_info($ip, 'location');
            $data['data']['visitor_country'] = $ipInfo['country'] ?? null;
            $data['data']['visitor_state'] = $ipInfo['state'] ?? null;
            $data['data']['visitor_city'] = $ipInfo['city'] ?? null;
            $data['data']['visitor_address'] = $ipInfo['address'] ?? $ip;
        }
        
        return $data;
    }

    public function logActivity(string $type, string $name, ?int $adminId = null): bool
    {
        $adminId = $adminId ?? session('id');
        
        return $this->insert([
            'fk_admin_id' => $adminId,
            'type' => $type,
            'name' => $name,
            'created_by' => $adminId
        ]) !== false;
    }

    public function logCrud(string $action, string $entity, $entityId = null): bool
    {
        $actionMap = [
            'create' => 'Created',
            'read' => 'Viewed',
            'update' => 'Updated',
            'delete' => 'Deleted'
        ];

        $name = ($actionMap[$action] ?? ucfirst($action)) . ' ' . $entity;
        
        if ($entityId) {
            $name .= " (ID: $entityId)";
        }

        return $this->logActivity('info', $name);
    }

    public function logSecurityEvent(string $event, string $details = ''): bool
    {
        return $this->logActivity('security', $event . ' - ' . $details);
    }
}
