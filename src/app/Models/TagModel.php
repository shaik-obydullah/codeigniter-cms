<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table         = 'tags';
    protected $primaryKey    = 'id';
    protected $returnType    = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'slug', 'color'];
}
