<?php

namespace App\Models;

use CodeIgniter\Model;

class WalletModel extends Model
{
    protected $table = 'wallets';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'name',
        'category'
    ];

    protected $deletedField = 'deleted_at';
    protected $useSoftDeletes = true;
    protected $beforeInsert = ['setCreatedAt', 'setCreatedBy'];
    protected $beforeUpdate = ['setUpdatedAt', 'setUpdatedBy'];

    protected $validationRules = [
        'name' => 'required|trim|min_length[2]|max_length[50]',
        'category' => 'required|in_list[income,expense]'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Wallet name is required',
            'min_length' => 'Wallet name must be at least 2 characters',
            'max_length' => 'Wallet name cannot exceed 50 characters',
            'is_unique' => 'This wallet name already exists'
        ],
        'category' => [
            'required' => 'Wallet category is required.',
            'in_list' => 'Wallet category must be either income or expense.'
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
