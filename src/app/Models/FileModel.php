<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table = 'files';
    protected $primaryKey = 'file_id';
    protected $allowedFields = ['file_id', 'file_name', 'file_type', 'file_url', 'create_time', 'create_date', 'created_by', 'modify_time', 'modify_date', 'modified_by'];
}
