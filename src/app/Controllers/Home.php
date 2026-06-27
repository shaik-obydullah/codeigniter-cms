<?php

namespace App\Controllers;
use App\Models\TagModel;
use App\Models\ArticleModel;
use App\Models\ProjectModel;
use App\Models\ConfigurationModel;
use App\Models\MessageModel;
use App\Models\ActivityModel;

class Home extends BaseController
{
    protected $db;
    public function index()
    {
        $activityModel = new ActivityModel();
        $activityModel->logActivity('warning', 'Website Visited');

        $configModel = new ConfigurationModel();
        // $cache = \Config\Services::cache();
        // $cacheKey = 'page_' . md5(uri_string());

        // $cachedOutput = $cache->get($cacheKey);
        // if ($cachedOutput !== null) {
        //      return $cachedOutput;
        // }

        $settings = $configModel->getAllConfigs();

        $data = [
            'settings' => $settings,
        ];

        $output = view('website/master', data: [
            'header' => view('website/header', $data),
            'footer' => view('website/footer', $data),
        ]);

        // $cacheDuration = (int) ($settings['website_cache'] ?? $configModel->defaultCacheTTL);

        // if ($cacheDuration > 0) {
        //      $cache->save($cacheKey, $output, $cacheDuration);
        // }

        return $output;
    }

    public function who_am_i()
    {
        $configModel = new ConfigurationModel();
        $configList = $configModel->getAllConfigs();

        $data = [
            'title' => 'Who Am I',
            'settings' => $configList,
            'date_format' => $configList['date_format'],
        ];

        return view('website/who_am_i', data: [
            'header' => view('website/header', $data),
            'footer' => view('website/footer', $data),
        ]);
    }

    private function limit_words(string $text, int $limit): string
    {
        $words = preg_split('/\s+/', $text);
        if (count($words) <= $limit) {
            return $text;
        }
        return implode(' ', array_slice($words, 0, $limit)) . '...';
    }

    public function projects()
    {
        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 6;

        $projectModel = new ProjectModel();
        $projects = $projectModel
            ->select("id, title, slug, image, SUBSTRING_INDEX(summary, ' ', 40) as summary")
            ->where('status', 'active')
            ->orderBy('serial', 'ASC')
            ->paginate($perPage, 'default', $page);

        $pager = $projectModel->pager;

        if (empty($projects)) {
            return $this->response->setJSON([
                'data' => [],
                'has_more' => false
            ]);
        }

        $formattedProjects = array_map(function ($project) {
            return [
                'id' => $project['id'],
                'title' => $project['title'],
                'slug' => $project['slug'],
                'image' => $project['image'],
                'summary' => $project['summary'],
            ];
        }, $projects);

        return $this->response->setJSON([
            'data' => $formattedProjects,
            'has_more' => $pager->hasMore()
        ]);
    }

    public function project($slug)
    {
        $this->db = \Config\Database::connect();
        $projectModel = new ProjectModel();


        $project = $projectModel->where('slug', $slug)
            ->where('status', 'active')
            ->first();

        if (!$project) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $tagModel = new TagModel();
        $relatedTags = [];
        $relatedProjects = [];

        $tagIds = $this->db->table('project_tags')
            ->where('fk_project_id', $project['id'])
            ->select('fk_tag_id')
            ->get()
            ->getResultArray();

        if (!empty($tagIds)) {
            $tagIds = array_column($tagIds, 'fk_tag_id');
            $relatedTags = $tagModel->whereIn('id', $tagIds)->findAll();

            $relatedProjects = $this->db->table('projects')
                ->select('projects.id, projects.title, projects.slug, projects.image, projects.summary, projects.status, projects.created_at')
                ->join('project_tags', 'project_tags.fk_project_id = projects.id')
                ->whereIn('project_tags.fk_tag_id', $tagIds)
                ->where('projects.id !=', $project['id'])
                ->where('projects.status', 'active')
                ->groupBy('projects.id')
                ->orderBy('projects.serial', 'ASC')
                ->limit(5)
                ->get()
                ->getResultArray();
        }

        $configModel = new ConfigurationModel();
        $configList = $configModel->getAllConfigs();

        $data = [
            'title' => $project['title'] ?? 'Project',
            'project' => $project,
            'date_format' => $configList['date_format'] ?? 'F j, Y',
            'relatedTags' => $relatedTags,
            'relatedProjects' => $relatedProjects,
            'settings' => $configList,
        ];

        return view('website/project', data: [
            'header' => view('website/header', $data),
            'footer' => view('website/footer', $data),
        ]);
    }

    public function articles()
    {
        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 6;

        $articleModel = new ArticleModel();
        $articles = $articleModel
            ->select("id, title, slug, image, SUBSTRING_INDEX(summary, ' ', 30) as summary")
            ->where('status', 'active')
            ->orderBy('serial', 'ASC')
            ->paginate($perPage, 'default', $page);

        $pager = $articleModel->pager;

        if (empty($articles)) {
            return $this->response->setJSON([
                'data' => [],
                'has_more' => false
            ]);
        }

        $formattedArticles = array_map(function ($article) {
            return [
                'id' => $article['id'],
                'title' => $article['title'],
                'slug' => $article['slug'],
                'summary' => $article['summary'],
            ];
        }, $articles);

        return $this->response->setJSON([
            'data' => $formattedArticles,
            'has_more' => $pager->hasMore()
        ]);
    }

    public function article($slug)
    {
        $this->db = \Config\Database::connect();
        $articleModel = new ArticleModel();

        $article = $articleModel->where('slug', $slug)
            ->where('status', 'active')
            ->first();

        if (!$article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $tagModel = new TagModel();

        $tagIds = $this->db->table('article_tags')
            ->where('fk_article_id', $article['id'])
            ->select('fk_tag_id')
            ->get()
            ->getResultArray();

        $tagIds = array_column($tagIds, 'fk_tag_id');

        $relatedTags = [];
        $relatedArticles = [];

        if (!empty($tagIds)) {
            $relatedTags = $tagModel->whereIn('id', $tagIds)->findAll();

            $relatedArticles = $this->db->table('articles')
                ->distinct()
                ->join('article_tags', 'article_tags.fk_article_id = articles.id')
                ->whereIn('article_tags.fk_tag_id', $tagIds)
                ->where('articles.id !=', $article['id'])
                ->where('articles.status', 'active')
                ->select('articles.id, articles.title, articles.slug, articles.image, articles.summary, articles.status, articles.created_at')
                ->orderBy('articles.serial', 'ASC')
                ->limit(5)
                ->get()
                ->getResultArray();
        }

        $configModel = new ConfigurationModel();
        $configList = $configModel->getAllConfigs();

        $data = [
            'title' => $article['title'],
            'article' => $article,
            'settings' => $configList,
            'date_format' => $configList['date_format'],
            'relatedTags' => $relatedTags,
            'relatedArticles' => $relatedArticles,
        ];

        return view('website/article', data: [
            'header' => view('website/header', $data),
            'footer' => view('website/footer', $data),
        ]);
    }

    public function contact_me()
    {
        if (!$this->request->isAJAX() || !$this->request->is('post')) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'error' => 'Invalid request method',
                'csrf_token' => csrf_hash()
            ]);
        }

        $messageModel = new MessageModel();

        $data = [
            'subject' => esc($this->request->getPost('subject')),
            'email' => esc($this->request->getPost('email')),
            'message' => esc($this->request->getPost('message')),
        ];

        try {
            if (!$messageModel->insert($data)) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors' => $messageModel->errors(),
                    'csrf_token' => csrf_hash()
                ]);
            }

            $activityModel = new ActivityModel();
            $activityModel->logActivity('warning', $data['email'] . ' New Message');

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Your message has been sent successfully!',
                'csrf_token' => csrf_hash()
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'error' => 'An unexpected error occurred. Please try again.',
                'csrf_token' => csrf_hash()
            ]);
        }
    }

    public function privacy_policy()
    {
        $configModel = new ConfigurationModel();
        $configList = $configModel->getAllConfigs();

        $data = [
            'title' => 'Privacy Policy',
            'settings' => $configList,
            'date_format' => $configList['date_format'],
        ];

        return view('website/privacy_policy', data: [
            'header' => view('website/header', $data),
            'footer' => view('website/footer', $data),
        ]);
    }
}