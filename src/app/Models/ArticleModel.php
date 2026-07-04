<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table         = 'articles';
    protected $primaryKey    = 'id';
    protected $returnType    = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'user_id', 'title', 'slug', 'content', 'excerpt',
        'featured_image', 'status', 'published_at',
        'meta_title', 'meta_description', 'serial',
    ];

    public function getCategories(int $articleId)
    {
        return $this->db->table('article_categories')
            ->select('categories.*')
            ->join('categories', 'categories.id = article_categories.category_id')
            ->where('article_categories.article_id', $articleId)
            ->get()
            ->getResult();
    }

    public function syncCategories(int $articleId, array $categoryIds): void
    {
        $this->db->table('article_categories')->where('article_id', $articleId)->delete();

        $data = [];
        foreach ($categoryIds as $categoryId) {
            $data[] = ['article_id' => $articleId, 'category_id' => $categoryId];
        }

        if (!empty($data)) {
            $this->db->table('article_categories')->insertBatch($data);
        }
    }

    public function getTags(int $articleId)
    {
        return $this->db->table('article_tags')
            ->select('tags.*')
            ->join('tags', 'tags.id = article_tags.tag_id')
            ->where('article_tags.article_id', $articleId)
            ->get()
            ->getResult();
    }

    public function syncTags(int $articleId, array $tagIds): void
    {
        $this->db->table('article_tags')->where('article_id', $articleId)->delete();

        $data = [];
        foreach ($tagIds as $tagId) {
            $data[] = ['article_id' => $articleId, 'tag_id' => $tagId];
        }

        if (!empty($data)) {
            $this->db->table('article_tags')->insertBatch($data);
        }
    }

    public function user()
    {
        return $this->belongsTo('App\Models\UserModel', 'user_id');
    }
}
