<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table         = 'projects';
    protected $primaryKey    = 'id';
    protected $returnType    = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'user_id', 'title', 'slug', 'description', 'excerpt',
        'url', 'featured_image', 'status', 'published_at',
        'meta_title', 'meta_description',
    ];

    public function getCategories(int $projectId)
    {
        return $this->db->table('project_categories')
            ->select('categories.*')
            ->join('categories', 'categories.id = project_categories.category_id')
            ->where('project_categories.project_id', $projectId)
            ->get()
            ->getResult();
    }

    public function syncCategories(int $projectId, array $categoryIds): void
    {
        $this->db->table('project_categories')->where('project_id', $projectId)->delete();

        $data = [];
        foreach ($categoryIds as $categoryId) {
            $data[] = ['project_id' => $projectId, 'category_id' => $categoryId];
        }

        if (!empty($data)) {
            $this->db->table('project_categories')->insertBatch($data);
        }
    }

    public function getTags(int $projectId)
    {
        return $this->db->table('project_tags')
            ->select('tags.*')
            ->join('tags', 'tags.id = project_tags.tag_id')
            ->where('project_tags.project_id', $projectId)
            ->get()
            ->getResult();
    }

    public function syncTags(int $projectId, array $tagIds): void
    {
        $this->db->table('project_tags')->where('project_id', $projectId)->delete();

        $data = [];
        foreach ($tagIds as $tagId) {
            $data[] = ['project_id' => $projectId, 'tag_id' => $tagId];
        }

        if (!empty($data)) {
            $this->db->table('project_tags')->insertBatch($data);
        }
    }
}
