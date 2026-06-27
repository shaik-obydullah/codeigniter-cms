<?php

namespace App\Models;

use CodeIgniter\Model;

class IncomeModel extends Model
{
    protected $table = 'incomes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'fk_wallet_id',
        'description',
        'amount',
        'currency',
        'created_at'
    ];

    protected $deletedField = 'deleted_at';
    protected $useSoftDeletes = true;
    protected $beforeInsert = ['setCreatedBy'];
    protected $beforeUpdate = ['setUpdatedAt', 'setUpdatedBy'];

    protected $validationRules = [
        'description' => 'required|min_length[3]|max_length[1000]',
        'amount' => 'required|decimal|greater_than[0]',
        'currency' => 'required'
    ];

    protected $validationMessages = [
        'description' => [
            'required' => 'Description is required.',
            'min_length' => 'Description must be at least 3 characters.',
            'max_length' => 'Description cannot exceed 1000 characters.'
        ],
        'amount' => [
            'required' => 'Amount is required.',
            'decimal' => 'Amount must be a valid decimal number.',
            'greater_than' => 'Amount must be greater than zero.'
        ],
        'currency' => [
            'required' => 'Currency is required.'
        ]
    ];

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
