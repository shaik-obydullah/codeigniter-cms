<?php
namespace App\Controllers;

use App\Models\TagModel;
use App\Models\ProjectModel;
use App\Models\ActivityModel;
use App\Models\ConfigurationModel;

class ProjectController extends BaseController
{
    protected $tagModel;
    protected $projectModel;
    protected $activityModel;
    protected $configModel;

    public function __construct()
    {
        $this->tagModel = new TagModel();
        $this->projectModel = new ProjectModel();
        $this->activityModel = new ActivityModel();
        $this->configModel = new ConfigurationModel();
    }

    public function index()
    {
        $configList = $this->configModel->getAllConfigs();
        $data = [
            'title' => 'My Projects',
            'paginate_rows' => $configList['paginate_rows'],
            'projects' => $this->projectModel->findAll()
        ];

        if ($this->request->isAJAX()) {
            return $this->response->setJSON($data['projects']);
        }

        $data['content'] = view('project/index', $data);
        return view('dashboard/master', $data);
    }

    public function list()
    {
        $configList = $this->configModel->getAllConfigs();

        $perPage = (int) $configList['paginate_rows'];
        $page = $this->request->getGet('page') ?? 1;
        $search = $this->request->getGet('search');
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        $builder = $this->projectModel->where('deleted_at', null);

        if (!empty($search)) {
            $builder->groupStart()
                ->like('title', $search)
                ->groupEnd();
        }

        if (!empty($startDate)) {
            $builder->where('created_at >=', $startDate);
        }

        if (!empty($endDate)) {
            $builder->where('created_at <=', $endDate . ' 23:59:59');
        }

        $offset = ($page - 1) * $perPage;
        $projects = $builder->orderBy('created_at', 'DESC')
            ->limit($perPage, $offset)
            ->findAll();

        $totalRecords = $this->projectModel->countAll();

        $filteredBuilder = clone $builder;
        $filteredCount = $filteredBuilder->countAllResults(false);

        foreach ($projects as $i => $row) {
            $projects[$i]['created_at'] = date($configList['date_format'], strtotime($row['created_at']));
        }

        $hasMore = ($offset + $perPage) < $filteredCount;

        return $this->response->setJSON([
            'success' => true,
            'data' => $projects,
            'total_records' => $totalRecords,
            'filtered_count' => $filteredCount,
            'has_more' => $hasMore,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function add()
    {
        $data = [
            'title' => 'Create New Project',
            'tags' => $this->tagModel->findAll()
        ];

        if ($this->request->isAJAX()) {
            return $this->response->setJSON($data['tags']);
        }

        $data['content'] = view('project/add', $data);
        return view('dashboard/master', $data);
    }

    private function createThumbnail(string $sourcePath, string $destPath, string $filename, int $width = 300, int $height = 300): string
    {
        \Config\Services::image()
            ->withFile($sourcePath . '/' . $filename)
            ->resize($width, $height, true, 'height')
            ->save($destPath . '/' . $filename);

        return $filename;
    }

    public function create()
    {
        $data = [];
        // $image = $this->request->getFile('image');

        // $uploadPath = FCPATH . 'uploads/projects';

        // $thumbPath = $uploadPath . '/thumb';

        // if ($image && $image->isValid() && !$image->hasMoved()) {
        //     if (!is_dir($uploadPath)) {
        //         mkdir($uploadPath, 0755, true);
        //     }
        //     if (!is_dir($thumbPath)) {
        //         mkdir($thumbPath, 0755, true);
        //     }

        //     $newName = $image->getRandomName();
        //     $image->move($uploadPath, $newName);

        //     $this->createThumbnail($uploadPath, $thumbPath, $newName);
        // }

        $db = \Config\Database::connect();
        $db->transStart();

        $created_at = (string) $this->request->getPost('createdAt');
        $created_at = empty($created_at) ? current_datetime() : $created_at . ' ' . date('H:i:s');

        $updated_at = (string) $this->request->getPost('updatedAt');
        $updated_at = empty($updated_at) ? current_datetime() : $updated_at . ' ' . date('H:i:s');

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'summary' => $this->request->getPost('summary'),
            'description' => $this->request->getPost('description'),
            // 'image' => isset($newName) ? $newName : null,
            'status' => $this->request->getPost('status'),
            'serial' => $this->request->getPost('serial'),
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];

        if (!$this->projectModel->insert($data)) {
            $db->transRollback();
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => $this->projectModel->errors(),
                    'csrf_token' => csrf_hash()
                ]);
        }

        $projectInsertId = $this->projectModel->getInsertID();

        $tags = [];
        $tagsJson = $this->request->getPost('tags');

        if (is_string($tagsJson)) {
            $tags = json_decode($tagsJson, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'success' => false,
                        'message' => 'Invalid JSON for tags',
                        'data' => $tagsJson,
                        'csrf_token' => csrf_hash()
                    ]);
            }
        }

        foreach ($tags as $tag) {
            if ($tag['id']) {
                $sql = "INSERT INTO project_tags (fk_project_id, fk_tag_id) VALUES (?, ?)";
                $db->query($sql, [$projectInsertId, $tag['id']]);
            } else {
                $this->tagModel->insert(['name' => $tag['name']]);
                $tagInsertId = $this->tagModel->getInsertID();

                $sql = "INSERT INTO project_tags (fk_project_id, fk_tag_id) VALUES (?, ?)";
                $db->query($sql, [$projectInsertId, $tagInsertId]);
            }
        }

        $this->activityModel->logActivity('success', 'New Project Created');

        $db->transComplete();

        if ($db->transStatus() === false) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Transaction failed',
                'csrf_token' => csrf_hash()
            ]);
        }

        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'success' => true,
                'csrf_token' => csrf_hash()
            ]);
    }

    public function select($id)
    {
        $project = $this->projectModel->find($id);

        if (!$project) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Invalid Project',
                    'csrf_token' => csrf_hash()
                ]);
        }

        $project['tags'] = $this->tagModel->getTagsForProject($id);

        if (!empty($project['created_at'])) {
            $project['created_at'] = date('Y-m-d', strtotime($project['created_at']));
        }

        if (!empty($project['updated_at'])) {
            $project['updated_at'] = date('Y-m-d', strtotime($project['updated_at']));
        }

        $data = [
            'title' => 'Edit Project',
            'project' => $project,
            'tags' => $this->tagModel->findAll()
        ];

        if ($this->request->isAJAX()) {
            return $this->response->setJSON($data);
        }

        $data['content'] = view('project/edit', $data);
        return view('dashboard/master', $data);
    }

    public function update()
    {
        $projectId = $this->request->getPost('id');

        if (!$projectId) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Project ID is required',
                'csrf_token' => csrf_hash()
            ]);
        }

        $existingProject = $this->projectModel->find($projectId);
        if (!$existingProject) {
            return $this->response->setStatusCode(404)->setJSON([
                'success' => false,
                'message' => 'Project not found',
                'csrf_token' => csrf_hash()
            ]);
        }

        $serial = trim($this->request->getPost('serial'));
        $existingSerial = $this->projectModel->where('serial', $serial)->where('id !=', $projectId)->first();

        if ($existingSerial) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => ['serial' => 'This serial is already exists'],
                    'csrf_token' => csrf_hash()
                ]);
        }

        $created_at = (string) $this->request->getPost('createdAt');
        $created_at = empty($created_at) ? current_datetime() : $created_at . ' ' . date('H:i:s');

        $updated_at = (string) $this->request->getPost('updatedAt');
        $updated_at = empty($updated_at) ? current_datetime() : $updated_at . ' ' . date('H:i:s');

        // $uploadPath = FCPATH . 'uploads/projects';
        // $thumbPath = $uploadPath . '/thumb';
        // $newName = null;

        $db = \Config\Database::connect();
        $db->transStart();

        // if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        //     if (!is_dir($uploadPath)) {
        //         mkdir($uploadPath, 0755, true);
        //     }
        //     if (!is_dir($thumbPath)) {
        //         mkdir($thumbPath, 0755, true);
        //     }

        //     $tmpName = $_FILES['image']['tmp_name'];
        //     $newName = uniqid() . '' . time();

        //     $destination = $uploadPath . '/' . $newName;
        //     if (move_uploaded_file($tmpName, $destination)) {
        //         $this->createThumbnail($uploadPath, $thumbPath, $newName);

        //         // Delete old image if exists
        //         if ($existingProject['image']) {
        //             $oldImagePath = $uploadPath . '/' . $existingProject['image'];
        //             $oldThumbPath = $thumbPath . '/' . $existingProject['image'];

        //             if (file_exists($oldImagePath)) {
        //                 unlink($oldImagePath);
        //             }
        //             if (file_exists($oldThumbPath)) {
        //                 unlink($oldThumbPath);
        //             }
        //         }
        //     }
        // }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'summary' => $this->request->getPost('summary'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
            'serial' => $this->request->getPost('serial'),
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];

        // if ($newName) {
        //     $data['image'] = $newName;
        // }

        if (!$this->projectModel->update($projectId, $data)) {
            $db->transRollback();
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Validation Failed',
                'errors' => $this->projectModel->errors(),
                'csrf_token' => csrf_hash()
            ]);
        }

        $tags = [];
        $tagsJson = $this->request->getPost('tags');

        if (is_string($tagsJson)) {
            $tags = json_decode($tagsJson, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $db->transRollback();
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Invalid JSON for tags',
                    'data' => $tagsJson,
                    'csrf_token' => csrf_hash()
                ]);
            }
        }

        $db->table('project_tags')->where('fk_project_id', $projectId)->delete();

        foreach ($tags as $tag) {
            if ($tag['id']) {
                $sql = "INSERT INTO project_tags (fk_project_id, fk_tag_id) VALUES (?, ?)";
                $db->query($sql, [$projectId, $tag['id']]);
            } else {
                $this->tagModel->insert(['name' => $tag['name']]);
                $tagInsertId = $this->tagModel->getInsertID();

                $sql = "INSERT INTO project_tags (fk_project_id, fk_tag_id) VALUES (?, ?)";
                $db->query($sql, [$projectId, $tagInsertId]);
            }
        }

        $this->activityModel->logActivity('success', 'Project Updated: ' . $data['title']);
        $db->transComplete();

        if ($db->transStatus() === false) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Transaction failed',
                'csrf_token' => csrf_hash()
            ]);
        }

        return $this->response->setStatusCode(200)->setJSON([
            'success' => true,
            'message' => 'Project updated successfully',
            'csrf_token' => csrf_hash()
        ]);
    }

    public function delete($id)
    {
        try {
            $db = \Config\Database::connect();
            $db->transStart();

            $project = $this->projectModel->find($id);
            if (!$project) {
                return $this->response->setStatusCode(404)->setJSON([
                    'success' => false,
                    'message' => 'Project not found',
                    'csrf_token' => csrf_hash()
                ]);
            }

            // Delete associated tags first
            $db->table('project_tags')->where('fk_project_id', $id)->delete();

            // Delete the project
            $this->projectModel->delete($id);

            // Delete image files if they exist
            // if (!empty($project['image'])) {
            //     $uploadPath = FCPATH . 'uploads/projects/';
            //     $thumbPath = $uploadPath . 'thumb/';

            //     $mainImage = $uploadPath . $project['image'];
            //     $thumbImage = $thumbPath . $project['image'];

            //     if (file_exists($mainImage)) {
            //         unlink($mainImage);
            //     }
            //     if (file_exists($thumbImage)) {
            //         unlink($thumbImage);
            //     }
            // }

            $this->activityModel->logActivity('warning', $project['title'] . ' Project Deleted');

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Project deleted successfully',
                'csrf_token' => csrf_hash()
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Failed to delete project: ' . $e->getMessage(),
                'csrf_token' => csrf_hash()
            ]);
        }
    }
}