<?php
namespace App\Controllers;

use App\Models\TagModel;
use App\Models\MediaModel;
use App\Models\ActivityModel;
use App\Models\ConfigurationModel;

class MediaController extends BaseController
{
    protected $tagModel;
    protected $mediaModel;
    protected $activityModel;
    protected $configModel;

    public function __construct()
    {
        $this->tagModel = new TagModel();
        $this->mediaModel = new MediaModel();
        $this->activityModel = new ActivityModel();
        $this->configModel = new ConfigurationModel();
    }

    public function index()
    {
        $configList = $this->configModel->getAllConfigs();
        $data = [
            'title' => 'Media Library',
            'paginate_rows' => $configList['paginate_rows'],
            'medias' => $this->mediaModel->findAll()
        ];

        if ($this->request->isAJAX()) {
            return $this->response->setJSON($data['medias']);
        }

        $data['content'] = view('media/index', $data);
        return view('dashboard/master', $data);
    }

    public function list()
    {
        $configList = $this->configModel->getAllConfigs();

        $perPage = (int) $configList['paginate_rows'];
        $page = $this->request->getGet('page') ?? 1;
        $search = $this->request->getGet('search');
        $type = $this->request->getGet('type');

        $builder = $this->mediaModel->where('deleted_at', null);

        if (!empty($search)) {
            $builder->groupStart()
                ->like('name', $search)
                ->groupEnd();
        }

        if (!empty($type)) {
            $builder->where('type ', $type);
        }

        $offset = ($page - 1) * $perPage;
        $medias = $builder->orderBy('id', 'DESC')
            ->limit($perPage, $offset)
            ->findAll();

        $totalRecords = $this->mediaModel->countAll();

        $filteredBuilder = clone $builder;
        $filteredCount = $filteredBuilder->countAllResults(false);

        $hasMore = ($offset + $perPage) < $filteredCount;

        return $this->response->setJSON([
            'success' => true,
            'data' => $medias,
            'total_records' => $totalRecords,
            'filtered_count' => $filteredCount,
            'has_more' => $hasMore,
            'csrf_token' => csrf_hash()
        ]);
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
        $file = $this->request->getFile('file');

        $uploadPath = FCPATH . 'uploads/media-library';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'type' => $this->request->getPost('type'),
            'url' => isset($newName) ? $newName : null,
        ];

        if (!$this->mediaModel->insert($data)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => $this->mediaModel->errors(),
                    'csrf_token' => csrf_hash()
                ]);
        }

        $newMedia = $this->mediaModel->find($this->mediaModel->getInsertID());

        $this->activityModel->logActivity('success', $data['name'] . ' New Media Created');

        return $this->response->setJSON([
            'success' => true,
            'media' => $newMedia,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function update($id)
    {
        $media = $this->mediaModel->find($id);
        if (!$media) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'success' => false,
                    'message' => 'Media not found',
                    'csrf_token' => csrf_hash()
                ]);
        }

        $data = [];
        $file = $this->request->getFile('file');
        $uploadPath = FCPATH . 'uploads/media-library';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // First delete the old file if it exists
            if ($media['url'] && file_exists($uploadPath . '/' . $media['url'])) {
                unlink($uploadPath . '/' . $media['url']);
            }

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $data['url'] = $newName;
        }

        $updateData = [
            'name' => $this->request->getPost('name'),
            'type' => $this->request->getPost('type'),
        ];

        // Only update URL if a new file was uploaded
        if (isset($data['url'])) {
            $updateData['url'] = $data['url'];
        }

        // Validate and update
        if (!$this->mediaModel->update($id, $updateData)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => $this->mediaModel->errors(),
                    'csrf_token' => csrf_hash()
                ]);
        }

        $updatedMedia = $this->mediaModel->find($id);

        $this->activityModel->logActivity('success', $updateData['name'] . ' Media Updated');

        return $this->response->setJSON([
            'success' => true,
            'media' => $updatedMedia,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function delete($id)
    {
        try {
            $media = $this->mediaModel->find($id);
            if (!$media) {
                return $this->response->setStatusCode(404)->setJSON([
                    'success' => false,
                    'message' => 'Media not found',
                    'csrf_token' => csrf_hash()
                ]);
            }

            // Delete the associated file if it exists
            $uploadPath = FCPATH . 'uploads/media-library';
            if (!empty($media['url']) && file_exists($uploadPath . '/' . $media['url'])) {
                if (!unlink($uploadPath . '/' . $media['url'])) {
                    log_message('error', 'Failed to delete media file: ' . $media['url']);
                    // Continue with DB deletion even if file deletion fails
                }
            }

            // Delete the database record
            if (!$this->mediaModel->delete($id)) {
                return $this->response->setStatusCode(500)->setJSON([
                    'success' => false,
                    'message' => 'Failed to delete media record',
                    'csrf_token' => csrf_hash()
                ]);
            }

            $this->activityModel->logActivity('warning', $media['name'] . ' Media Deleted');

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Media deleted successfully',
                'csrf_token' => csrf_hash()
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Media deletion error: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'An error occurred while deleting media',
                'error' => env('CI_ENVIRONMENT') === 'development' ? $e->getMessage() : null,
                'csrf_token' => csrf_hash()
            ]);
        }
    }
}