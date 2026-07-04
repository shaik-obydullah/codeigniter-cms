<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaModel extends Model
{
    protected $table         = 'media';
    protected $primaryKey    = 'id';
    protected $returnType    = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'user_id', 'filename', 'original_name', 'path',
        'type', 'size', 'alt_text',
    ];
}
