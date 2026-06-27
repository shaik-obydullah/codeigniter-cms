<?php
namespace App\Controllers;

use App\Models\TagModel;
use App\Models\ActivityModel;
use App\Models\ConfigurationModel;

class TagController extends BaseController
{
    protected $tagModel;
    protected $configModel;
    protected $activityModel;

    public function __construct()
    {
        $this->tagModel = new TagModel();
        $this->activityModel = new ActivityModel();
        $this->configModel = new ConfigurationModel();
    }

    public function index()
    {
        $configList = $this->configModel->getAllConfigs();

        $data = [
            'title' => 'Tag Management',
            'paginate_rows' => $configList['paginate_rows'],
        ];

        $data['content'] = view('tag/index', $data);
        return view('dashboard/master', $data);
    }

    public function search()
    {
        $search = $this->request->getGet('search');

        $this->tagModel->where('deleted_at', null);

        if (!empty($search)) {
            $this->tagModel->groupStart()
                ->like('name', $search)
                ->groupEnd();
        }

        $tags = $this->tagModel->orderBy('id', 'DESC')->findAll();

        return $this->response->setJSON([
            'success' => true,
            'data' => $tags,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function list()
    {
        $configList = $this->configModel->getAllConfigs();
        $perPage = (int) $configList['paginate_rows'];
        $page = $this->request->getGet('page') ?? 1;
        $search = $this->request->getGet('search');

        $builder = $this->tagModel
            ->where('deleted_at', null);

        if (!empty($search)) {
            $builder->groupStart()
                ->like('name', $search)
                ->groupEnd();
        }

        $offset = ($page - 1) * $perPage;
        $tags = $builder->orderBy('id', 'DESC')
            ->limit($perPage, $offset)
            ->findAll();

        $totalRecords = $this->tagModel->countAll();

        $filteredBuilder = clone $builder;
        $filteredCount = $filteredBuilder->countAllResults(false);

        $hasMore = ($offset + $perPage) < $filteredCount;

        return $this->response->setJSON([
            'success' => true,
            'data' => $tags,
            'total_records' => $totalRecords,
            'filtered_count' => $filteredCount,
            'has_more' => $hasMore,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function create()
    {
        $name = trim($this->request->getPost('name'));
        $existingTag = $this->tagModel->where('name', $name)->first();

        if ($existingTag) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => ['name' => 'This tag name already exists'],
                    'csrf_token' => csrf_hash()
                ]);
        }

        $data = [
            'name' => $name,
        ];

        if (!$this->tagModel->insert($data)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => $this->tagModel->errors(),
                    'csrf_token' => csrf_hash()
                ]);
        }

        $newTag = $this->tagModel->find($this->tagModel->getInsertID());

        $this->activityModel->logActivity('success', $data['name'] . ' Tag Created');

        return $this->response->setJSON([
            'success' => true,
            'tag' => $newTag,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function update($id)
    {
        $name = trim($this->request->getPost('name'));
        $existingTag = $this->tagModel->where('name', $name)->where('id !=', $id)->first();

        if ($existingTag) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => ['name' => 'This tag name already exists'],
                    'csrf_token' => csrf_hash()
                ]);
        }

        $data = [
            'name' => $name,
        ];

        if (!$this->tagModel->update($id, $data)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => $this->tagModel->errors(),
                    'csrf_token' => csrf_hash()
                ]);
        }

        try {
            $updatedTag = $this->tagModel->find($id);

            $this->activityModel->logActivity('warning', $updatedTag['name'] . ' Tag Updated');

            return $this->response->setJSON([
                'success' => true,
                'tag' => $updatedTag,
                'csrf_token' => csrf_hash()
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'error' => 'Failed to update tag',
                'csrf_token' => csrf_hash()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $tag = $this->tagModel->find($id);
            if (!$tag) {
                return $this->response->setStatusCode(404)->setJSON([
                    'success' => false,
                    'message' => 'Tag not found',
                    'csrf_token' => csrf_hash()
                ]);
            }

            $this->tagModel->delete($id);

            $this->activityModel->logActivity('warning', $tag['name'] . ' Tag Deleted');

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Tag deleted successfully',
                'csrf_token' => csrf_hash()
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'error' => 'Failed to delete tag',
                'csrf_token' => csrf_hash()
            ]);
        }
    }
}