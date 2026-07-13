<?php

namespace App\Models;

use CodeIgniter\Model;

class SkillModel extends Model
{
    protected $table         = 'skills';
    protected $primaryKey    = 'id';
    protected $returnType    = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'icon', 'description', 'serial'];

    public function reorder(array $orders): void
    {
        foreach ($orders as $item) {
            $this->update($item['id'], ['serial' => $item['serial']]);
        }
    }
}
