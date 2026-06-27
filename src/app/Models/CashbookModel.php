<?php

namespace App\Models;

use CodeIgniter\Model;

class CashbookModel extends Model
{
    protected $table = 'cashbook';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'in_amount',
        'out_amount',
        'fk_reference_id',
        'created_at'
    ];

    protected $deletedField = 'deleted_at';
    protected $useSoftDeletes = true;
    protected $beforeInsert = ['setCreatedBy'];
    protected $beforeUpdate = ['setUpdatedAt', 'setUpdatedBy'];

    protected $validationRules = [
        'fk_reference_id' => 'required'
    ];

    protected $validationMessages = [
        'fk_reference_id' => [
            'required' => 'Reference is required.',
        ],
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
