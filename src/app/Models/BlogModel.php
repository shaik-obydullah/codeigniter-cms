<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model {

    protected $table = 'blogs';
    protected $primaryKey = 'blog_id';
    protected $allowedFields = ['blog_title', 'blog_slug', 'blog_summary', 'blog', 'featured_image', 'blog_status', 'create_time', 'create_date', 'created_by', 'modify_time', 'modify_date', 'modified_by'];

}
