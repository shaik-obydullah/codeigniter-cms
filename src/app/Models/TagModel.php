<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'name',
        'slug'
    ];

    protected $deletedField = 'deleted_at';
    protected $useSoftDeletes = true;
    protected $beforeInsert = ['generateSlug', 'setCreatedAt', 'setCreatedBy'];
    protected $beforeUpdate = ['generateSlug', 'setUpdatedAt', 'setUpdatedBy'];

    protected $validationRules = [
        'name' => 'required|trim|min_length[2]|max_length[50]',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Tag name is required',
            'min_length' => 'Tag name must be at least 2 characters',
            'max_length' => 'Tag name cannot exceed 100 characters',
        ]
    ];

    protected function generateSlug(array $data)
    {
        if (!empty($data['data']['name']) && empty($data['data']['slug'])) {
            $data['data']['slug'] = $this->createSlug($data['data']['name'], $data['data']['id'] ?? 0);
        }
        return $data;
    }

    public function createSlug(string $name, int $excludeId = 0): string
    {
        $slug = url_title($name, '-', true);
        $originalSlug = $slug;
        $count = 1;

        while ($this->slugExists($slug, $excludeId)) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    protected function slugExists(string $slug, int $excludeId = 0): bool
    {
        return $this->where('slug', $slug)
            ->where('id !=', $excludeId)
            ->countAllResults() > 0;
    }

    public function getTagsForArticle($articleId)
    {
        return $this->db->table('article_tags')
            ->select('tags.id, tags.name, tags.slug, tags.created_at, tags.created_by')
            ->join('tags', 'tags.id = article_tags.fk_tag_id')
            ->where('article_tags.fk_article_id', $articleId)
            ->get()
            ->getResultArray();
    }

    public function getTagsForProject($articleId)
    {
        return $this->db->table('project_tags')
            ->select('tags.id, tags.name, tags.slug, tags.created_at, tags.created_by')
            ->join('tags', 'tags.id = project_tags.fk_tag_id')
            ->where('project_tags.fk_project_id', $articleId)
            ->get()
            ->getResultArray();
    }

    protected function setCreatedAt(array $data)
    {
        $data['data']['created_at'] = current_datetime();
        return $data;
    }

    protected function setCreatedBy(array $data)
    {
        $data['data']['created_by'] = session()->get('id');
        return $data;
    }

    protected function setUpdatedAt(array $data)
    {
        $data['data']['updated_at'] = current_datetime();
        return $data;
    }

    protected function setUpdatedBy(array $data)
    {
        $data['data']['updated_by'] = session()->get('id');
        return $data;
    }
}
