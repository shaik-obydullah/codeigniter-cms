<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaModel extends Model
{
    protected $table = 'files';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'type',
        'url'
    ];
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';

    protected $beforeInsert = ['setCreatedAt', 'setCreatedBy'];
    protected $beforeUpdate = ['setUpdatedAt', 'setUpdatedBy'];
        
    protected $validationRules = [
        'name' => 'required',
    ];
    
    protected $validationMessages = [
        'title' => [
            'required' => 'Media file is required',
        ]
    ];

    protected function setCreatedAt(array $data)
    {
        $data['data']['created_at'] = current_datetime();
        return $data;
    }
    
    protected function setCreatedBy(array $data)
    {
        $data['data']['created_by'] = session()->get('id');
        return $data;
    }

    protected function setUpdatedAt(array $data)
    {
        $data['data']['updated_at'] = current_datetime();
        return $data;
    }

    protected function setUpdatedBy(array $data)
    {
        $data['data']['updated_by'] = session()->get('id');
        return $data;
    }
}
