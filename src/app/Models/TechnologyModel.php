<?php

namespace App\Models;

use CodeIgniter\Model;

class TechnologyModel extends Model
{
    protected $table         = 'technologies';
    protected $primaryKey    = 'id';
    protected $returnType    = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = ['name'];
}
