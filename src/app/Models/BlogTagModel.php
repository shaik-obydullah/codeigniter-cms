<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogTagModel extends Model
{
    protected $table = 'blogtag_relaton';
    protected $primaryKey = 'relaton_id';
    protected $allowedFields = ['relaton_id', 'fk_blog_id', 'fk_tag_id'];
}
