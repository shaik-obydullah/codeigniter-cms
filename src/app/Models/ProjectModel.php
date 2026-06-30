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

    public function getTechnologies(int $projectId)
    {
        return $this->db->table('project_technologies')
            ->select('technologies.*')
            ->join('technologies', 'technologies.id = project_technologies.technology_id')
            ->where('project_technologies.project_id', $projectId)
            ->get()
            ->getResult();
    }

    public function syncTechnologies(int $projectId, array $technologyIds): void
    {
        $this->db->table('project_technologies')->where('project_id', $projectId)->delete();

        $data = [];
        foreach ($technologyIds as $technologyId) {
            $data[] = ['project_id' => $projectId, 'technology_id' => $technologyId];
        }

        if (!empty($data)) {
            $this->db->table('project_technologies')->insertBatch($data);
        }
    }
}
