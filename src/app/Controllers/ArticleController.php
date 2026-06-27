<?php
namespace App\Controllers;

use App\Models\TagModel;
use App\Models\ArticleModel;
use App\Models\ActivityModel;
use App\Models\ConfigurationModel;

class ArticleController extends BaseController
{
    protected $tagModel;
    protected $articleModel;
    protected $activityModel;
    protected $configModel;

    public function __construct()
    {
        $this->tagModel = new TagModel();
        $this->articleModel = new ArticleModel();
        $this->activityModel = new ActivityModel();
        $this->configModel = new ConfigurationModel();
    }

    public function index()
    {
        $configList = $this->configModel->getAllConfigs();
        $data = [
            'title' => 'My Articles',
            'paginate_rows' => $configList['paginate_rows'],
            'articles' => $this->articleModel->findAll()
        ];

        if ($this->request->isAJAX()) {
            return $this->response->setJSON($data['articles']);
        }

        $data['content'] = view('article/index', $data);
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

        $builder = $this->articleModel->where('deleted_at', null);

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
        $articles = $builder->orderBy('created_at', 'DESC')
            ->limit($perPage, $offset)
            ->findAll();

        $totalRecords = $this->articleModel->countAll();

        $filteredBuilder = clone $builder;
        $filteredCount = $filteredBuilder->countAllResults(false);

        foreach ($articles as $i => $row) {
            $articles[$i]['created_at'] = date($configList['date_format'], strtotime($row['created_at']));
        }

        $hasMore = ($offset + $perPage) < $filteredCount;

        return $this->response->setJSON([
            'success' => true,
            'data' => $articles,
            'total_records' => $totalRecords,
            'filtered_count' => $filteredCount,
            'has_more' => $hasMore,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function add()
    {
        $data = [
            'title' => 'Create New Article',
            'tags' => $this->tagModel->findAll()
        ];

        if ($this->request->isAJAX()) {
            return $this->response->setJSON($data['tags']);
        }

        $data['content'] = view('article/add', $data);
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
        $serial = trim($this->request->getPost('serial'));
        $existingSerial = $this->articleModel->where('serial', $serial)->first();

        if ($existingSerial) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => ['name' => 'This serial is already exists'],
                    'csrf_token' => csrf_hash()
                ]);
        }

        $data = [];
        // $image = $this->request->getFile('image');

        // $uploadPath = FCPATH . 'uploads/articles';

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

        if (!$this->articleModel->insert($data)) {
            $db->transRollback();
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => $this->articleModel->errors(),
                    'csrf_token' => csrf_hash()
                ]);
        }

        $articleInsertId = $this->articleModel->getInsertID();

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
                $sql = "INSERT INTO article_tags (fk_article_id, fk_tag_id) VALUES (?, ?)";
                $db->query($sql, [$articleInsertId, $tag['id']]);
            } else {
                $this->tagModel->insert(['name' => $tag['name']]);
                $tagInsertId = $this->tagModel->getInsertID();

                $sql = "INSERT INTO article_tags (fk_article_id, fk_tag_id) VALUES (?, ?)";
                $db->query($sql, [$articleInsertId, $tagInsertId]);
            }
        }

        $this->activityModel->logActivity('success', 'New Article Created');

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
        $article = $this->articleModel->find($id);

        if (!$article) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Invalid Article',
                    'csrf_token' => csrf_hash()
                ]);
        }

        $article['tags'] = $this->tagModel->getTagsForArticle($id);

        if (!empty($article['created_at'])) {
            $article['created_at'] = date('Y-m-d', strtotime($article['created_at']));
        }

        if (!empty($article['updated_at'])) {
            $article['updated_at'] = date('Y-m-d', strtotime($article['updated_at']));
        }

        $data = [
            'title' => 'Edit Article',
            'article' => $article,
            'tags' => $this->tagModel->findAll()
        ];

        if ($this->request->isAJAX()) {
            return $this->response->setJSON($data);
        }

        $data['content'] = view('article/edit', $data);
        return view('dashboard/master', $data);
    }

    public function update()
    {
        $articleId = $this->request->getPost('id');

        if (!$articleId) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Article ID is required',
                'csrf_token' => csrf_hash()
            ]);
        }

        $existingArticle = $this->articleModel->find($articleId);
        if (!$existingArticle) {
            return $this->response->setStatusCode(404)->setJSON([
                'success' => false,
                'message' => 'Article not found',
                'csrf_token' => csrf_hash()
            ]);
        }

        $serial = trim($this->request->getPost('serial'));
        $existingSerial = $this->articleModel->where('serial', $serial)->where('id !=', $articleId)->first();

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

        $uploadPath = FCPATH . 'uploads/articles';
        $thumbPath = $uploadPath . '/thumb';
        $newName = null;

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
        //         if ($existingArticle['image']) {
        //             $oldImagePath = $uploadPath . '/' . $existingArticle['image'];
        //             $oldThumbPath = $thumbPath . '/' . $existingArticle['image'];

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

        if (!$this->articleModel->update($articleId, $data)) {
            $db->transRollback();
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Validation Failed',
                'errors' => $this->articleModel->errors(),
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

        $db->table('article_tags')->where('fk_article_id', $articleId)->delete();

        foreach ($tags as $tag) {
            if ($tag['id']) {
                $sql = "INSERT INTO article_tags (fk_article_id, fk_tag_id) VALUES (?, ?)";
                $db->query($sql, [$articleId, $tag['id']]);
            } else {
                $this->tagModel->insert(['name' => $tag['name']]);
                $tagInsertId = $this->tagModel->getInsertID();

                $sql = "INSERT INTO article_tags (fk_article_id, fk_tag_id) VALUES (?, ?)";
                $db->query($sql, [$articleId, $tagInsertId]);
            }
        }

        $this->activityModel->logActivity('success', 'Article Updated: ' . $data['title']);
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
            'message' => 'Article updated successfully',
            'csrf_token' => csrf_hash()
        ]);
    }

    public function delete($id)
    {
        try {
            $db = \Config\Database::connect();
            $db->transStart();

            $article = $this->articleModel->find($id);
            if (!$article) {
                return $this->response->setStatusCode(404)->setJSON([
                    'success' => false,
                    'message' => 'Article not found',
                    'csrf_token' => csrf_hash()
                ]);
            }

            // Delete associated tags first
            $db->table('article_tags')->where('fk_article_id', $id)->delete();

            // Delete the article
            $this->articleModel->delete($id);

            // Delete image files if they exist
            // if (!empty($article['image'])) {
            //     $uploadPath = FCPATH . 'uploads/articles/';
            //     $thumbPath = $uploadPath . 'thumb/';

            //     $mainImage = $uploadPath . $article['image'];
            //     $thumbImage = $thumbPath . $article['image'];

            //     if (file_exists($mainImage)) {
            //         unlink($mainImage);
            //     }
            //     if (file_exists($thumbImage)) {
            //         unlink($thumbImage);
            //     }
            // }

            $this->activityModel->logActivity('warning', $article['title'] . ' Article Deleted');

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Article deleted successfully',
                'csrf_token' => csrf_hash()
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Failed to delete article: ' . $e->getMessage(),
                'csrf_token' => csrf_hash()
            ]);
        }
    }
}