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
        'article_id', 'project_id', 'user_id', 'author_name', 'author_email', 'content', 'status',
    ];

    public function getPaginatedComments(?string $status = null, int $perPage = 20)
    {
        $this->select('comments.*, articles.title as article_title')
            ->join('articles', 'articles.id = comments.article_id', 'left')
            ->orderBy('comments.created_at', 'DESC');

        if ($status) {
            $this->where('comments.status', $status);
        }

        return $this->paginate($perPage);
    }
}
