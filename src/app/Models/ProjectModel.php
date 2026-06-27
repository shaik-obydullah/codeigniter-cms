<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title',
        'serial',
        'slug',
        'summary',
        'description',
        'image',
        'status',
        'created_at',
        'updated_at',
    ];
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';

    protected $beforeInsert = ['setCreatedBy'];
    protected $beforeUpdate = ['setUpdatedBy'];
        
    protected $validationRules = [
        'title' => 'required|min_length[1]|max_length[250]',
        'serial' => 'required',
        'summary' => 'required|min_length[1]',
        'description' => 'required|min_length[1]',
        'status' => 'required|in_list[active,inactive]'
    ];
    
    protected $validationMessages = [
        'title' => [
            'required' => 'Project title is required',
            'min_length' => 'Title must be at least 5 characters'
        ]
    ];

    protected function setCreatedBy(array $data)
    {
        $data['data']['created_by'] = session()->get('id');
        return $data;
    }

    protected function setUpdatedBy(array $data)
    {
        $data['data']['updated_by'] = session()->get('id');
        return $data;
    }
}
