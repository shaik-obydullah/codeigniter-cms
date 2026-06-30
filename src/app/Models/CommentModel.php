<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table         = 'comments';
    protected $primaryKey    = 'id';
    protected $returnType    = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'article_id', 'user_id', 'author_name', 'author_email', 'content', 'status',
    ];
}
