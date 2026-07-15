<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\CommentModel;
use App\Models\NotificationModel;
use App\Models\ProjectModel;

class Pages extends BaseController
{
    public function about()
    {
        $categories = model('CategoryModel')->orderBy('name', 'ASC')->findAll();
        $tags       = model('TagModel')->orderBy('name', 'ASC')->findAll();
        $projects   = model(ProjectModel::class)->where('status', 'published')->orderBy('created_at', 'DESC')->findAll(4);

        return view('about', [
            'categories' => $categories,
            'tags'       => $tags,
            'projects'   => $projects,
        ]);
    }

    public function projects()
    {
        $projectModel = model(ProjectModel::class);
        $category = $this->request->getGet('category');
        $tag      = $this->request->getGet('tag');

        if ($category) {
            $catModel = model('CategoryModel');
            $cat = $catModel->where('slug', $category)->first();
            if ($cat) {
                $projectModel->join('project_categories', 'project_categories.project_id = projects.id')
                    ->where('project_categories.category_id', $cat->id);
            }
        }

        if ($tag) {
            $tagModel = model('TagModel');
            $t = $tagModel->where('slug', $tag)->first();
            if ($t) {
                $projectModel->join('project_tags', 'project_tags.project_id = projects.id')
                    ->where('project_tags.tag_id', $t->id);
            }
        }

        $projects = $projectModel->where('status', 'published')->orderBy('serial', 'ASC')->paginate(12);

        if (!empty($projects)) {
            $projectIds = array_map(function ($p) {
                return $p->id;
            }, $projects);
            $categories = $projectModel->getCategoriesForProjects($projectIds);
            $tags       = $projectModel->getTagsForProjects($projectIds);
            foreach ($projects as $project) {
                $project->category_name = $categories[$project->id] ?? '';
                $project->tags_str      = $tags[$project->id] ?? '';
            }
        }

        $allProjectsModel = model(ProjectModel::class);
        $allProjects = $allProjectsModel->where('status', 'published')->orderBy('serial', 'ASC')->findAll();
        if (!empty($allProjects)) {
            $allIds = array_map(function ($p) {
                return $p->id;
            }, $allProjects);
            $allCats = $projectModel->getCategoriesForProjects($allIds);
            $allTagsData = $projectModel->getTagsForProjects($allIds);
            foreach ($allProjects as $p) {
                $p->category_name = $allCats[$p->id] ?? '';
                $p->tags_str = $allTagsData[$p->id] ?? '';
            }
        }

        $allCategories = model('CategoryModel')->orderBy('name', 'ASC')->findAll();
        $allTags       = model('TagModel')->orderBy('name', 'ASC')->findAll();

        return view('projects', [
            'projects'     => $projects,
            'allProjects'  => $allProjects,
            'categories'   => $allCategories,
            'tags'         => $allTags,
            'pager'        => $projectModel->pager,
            'filterCat'    => $category,
            'filterTag'    => $tag,
        ]);
    }

    public function projectDetails($slug = null)
    {
        $projectModel = model(ProjectModel::class);
        $project = $projectModel->where('slug', $slug)->first();

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        $categories   = model('CategoryModel')->orderBy('name', 'ASC')->findAll();
        $tags         = model('TagModel')->orderBy('name', 'ASC')->findAll();
        $projectCats  = $projectModel->getCategories($project->id);
        $projectTags  = $projectModel->getTags($project->id);
        $recentProjects = $projectModel->where('status', 'published')->where('id !=', $project->id)->orderBy('created_at', 'DESC')->findAll(4);
        $comments = model(CommentModel::class)->where('project_id', $project->id)->where('status', 'approved')->orderBy('created_at', 'ASC')->findAll();

        return view('project_details', [
            'project'        => $project,
            'categories'     => $categories,
            'tags'           => $tags,
            'projectCats'    => $projectCats,
            'projectTags'    => $projectTags,
            'recentProjects' => $recentProjects,
            'comments'       => $comments,
        ]);
    }

    public function submitComment()
    {
        if (! auth()->loggedIn()) {
            return redirect()->to('/user-login');
        }

        $rules = [
            'content' => 'required|min_length[3]',
        ];

        $projectId = $this->request->getPost('project_id');
        $articleId = $this->request->getPost('article_id');

        if ($projectId) {
            $rules['project_id'] = 'is_natural_no_zero';
        } elseif ($articleId) {
            $rules['article_id'] = 'is_natural_no_zero';
        } else {
            return redirect()->back()->withInput()->with('error', 'Missing comment target.');
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = auth()->user();

        $data = [
            'user_id'      => $user->id,
            'author_name'  => $user->username,
            'author_email' => $user->email,
            'content'      => $this->request->getPost('content'),
            'status'       => 'pending',
        ];

        if ($projectId) {
            $data['project_id'] = $projectId;
        } elseif ($articleId) {
            $data['article_id'] = $articleId;
        }

        model(CommentModel::class)->insert($data);

        $adminUsers = model(NotificationModel::class)->db->table('auth_groups_users')
            ->whereIn('group', ['superadmin', 'admin'])
            ->get()
            ->getResult();

        $itemTitle = '';
        if ($projectId) {
            $item     = model(ProjectModel::class)->find($projectId);
            $itemTitle = $item->title ?? 'a project';
        } elseif ($articleId) {
            $item     = model(ArticleModel::class)->find($articleId);
            $itemTitle = $item->title ?? 'an article';
        }

        foreach ($adminUsers as $au) {
            model(NotificationModel::class)->insert([
                'user_id' => $au->user_id,
                'type'    => 'comment',
                'title'   => 'New Comment',
                'message' => $user->username . ' commented on "' . esc($itemTitle) . '"',
                'link'    => '/dashboard/comments',
                'is_read' => 0,
            ]);
        }

        return redirect()->back()->with('message', 'Your comment has been submitted and is pending approval.');
    }

    public function articles()
    {
        $articleModel = model(ArticleModel::class);
        $category = $this->request->getGet('category');
        $tag      = $this->request->getGet('tag');

        if ($category) {
            $catModel = model('CategoryModel');
            $cat = $catModel->where('slug', $category)->first();
            if ($cat) {
                $articleModel->join('article_categories', 'article_categories.article_id = articles.id')
                    ->where('article_categories.category_id', $cat->id);
            }
        }

        if ($tag) {
            $tagModel = model('TagModel');
            $t = $tagModel->where('slug', $tag)->first();
            if ($t) {
                $articleModel->join('article_tags', 'article_tags.article_id = articles.id')
                    ->where('article_tags.tag_id', $t->id);
            }
        }

        $articles     = $articleModel->where('status', 'published')->orderBy('serial', 'ASC')->paginate(12);

        if (!empty($articles)) {
            $articleIds = array_map(function ($a) {
                return $a->id;
            }, $articles);
            $categories = $articleModel->getCategoriesForArticles($articleIds);
            $tags       = $articleModel->getTagsForArticles($articleIds);
            foreach ($articles as $article) {
                $article->category_name = $categories[$article->id] ?? '';
                $article->tags_str      = $tags[$article->id] ?? '';
            }
        }

        $allArticlesModel = model(ArticleModel::class);
        $allArticles = $allArticlesModel->where('status', 'published')->orderBy('serial', 'ASC')->findAll();
        if (!empty($allArticles)) {
            $allIds = array_map(function ($a) {
                return $a->id;
            }, $allArticles);
            $allCats = $articleModel->getCategoriesForArticles($allIds);
            $allTagsData = $articleModel->getTagsForArticles($allIds);
            foreach ($allArticles as $a) {
                $a->category_name = $allCats[$a->id] ?? '';
                $a->tags_str = $allTagsData[$a->id] ?? '';
            }
        }

        $allCategories = model('CategoryModel')->orderBy('name', 'ASC')->findAll();
        $allTags       = model('TagModel')->orderBy('name', 'ASC')->findAll();

        return view('articles', [
            'articles'     => $articles,
            'allArticles'  => $allArticles,
            'categories'   => $allCategories,
            'tags'         => $allTags,
            'pager'        => $articleModel->pager,
            'filterCat'    => $category,
            'filterTag'    => $tag,
        ]);
    }

    public function articleDetails($slug = null)
    {
        $article = model(ArticleModel::class)->where('slug', $slug)->first();

        if (!$article) {
            return redirect()->to('/articles')->with('error', 'Article not found.');
        }

        $categories   = model('CategoryModel')->orderBy('name', 'ASC')->findAll();
        $tags         = model('TagModel')->orderBy('name', 'ASC')->findAll();
        $articleCats  = model(ArticleModel::class)->getCategories($article->id);
        $articleTags  = model(ArticleModel::class)->getTags($article->id);
        $recentPosts  = model(ArticleModel::class)->where('status', 'published')->where('id !=', $article->id)->orderBy('created_at', 'DESC')->findAll(4);
        $comments     = model(CommentModel::class)->where('article_id', $article->id)->where('status', 'approved')->orderBy('created_at', 'ASC')->findAll();

        return view('article_details', [
            'article'     => $article,
            'categories'  => $categories,
            'tags'        => $tags,
            'articleCats' => $articleCats,
            'articleTags' => $articleTags,
            'recentPosts' => $recentPosts,
            'comments'    => $comments,
        ]);
    }

    public function contact()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'name'    => 'required|min_length[2]',
                'email'   => 'required|valid_email',
                'subject' => 'required|min_length[2]',
                'message' => 'required|min_length[10]',
            ];

            if (!$this->validate($rules)) {
                if ($this->request->getHeaderLine('X-Requested-With') === 'XMLHttpRequest') {
                    return $this->response->setJSON([
                        'success' => false,
                        'errors'  => $this->validator->getErrors(),
                    ]);
                }
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $model = new \App\Models\MessagesModel();
            $saved = $model->save([
                'name'    => $this->request->getPost('name'),
                'email'   => $this->request->getPost('email'),
                'subject' => $this->request->getPost('subject'),
                'message' => $this->request->getPost('message'),
            ]);

            if (!$saved) {
                if ($this->request->getHeaderLine('X-Requested-With') === 'XMLHttpRequest') {
                    return $this->response->setJSON([
                        'success' => false,
                        'error'   => 'Failed to save message. Please try again.',
                    ]);
                }
                return redirect()->back()->with('error', 'Failed to save message.');
            }

            $name    = $this->request->getPost('name');
            $subject = $this->request->getPost('subject');
            $userId  = auth()->id() ?? 1;

            try {
                $notifModel = new \App\Models\NotificationModel();
                $notifModel->save([
                    'user_id' => $userId,
                    'type'    => 'message',
                    'title'   => 'New message from ' . $name,
                    'message' => $subject,
                    'link'    => '/dashboard/messages',
                    'is_read' => 0,
                ]);
            } catch (\Exception $e) {
                // notification failed, continue silently
            }

            if ($this->request->getHeaderLine('X-Requested-With') === 'XMLHttpRequest') {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Your message has been sent. Thank you!',
                ]);
            }

            return redirect()->to('/contact')->with('message', 'Your message has been sent. Thank you!');
        }

        return view('contact');
    }

    public function documentation()
    {
        return view('documentation');
    }

    public function docLimeCss()
    {
        return view('doc/lime_css_framework');
    }

    public function docRestaurantPos()
    {
        return view('doc/wordpress_restaurant_pos_lite_plugin');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function terms()
    {
        return view('terms');
    }
}
