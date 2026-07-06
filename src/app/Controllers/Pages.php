<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\ProjectModel;

class Pages extends BaseController
{
    public function about()
    {
        return view('about');
    }

    public function projects()
    {
        $projectModel = model(ProjectModel::class);
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

        $allCategories = model('CategoryModel')->orderBy('name', 'ASC')->findAll();
        $allTags       = model('TagModel')->orderBy('name', 'ASC')->findAll();

        return view('projects', [
            'projects'    => $projects,
            'categories'  => $allCategories,
            'tags'        => $allTags,
            'pager'       => $projectModel->pager,
        ]);
    }

    public function projectDetails($slug = null)
    {
        $projectModel = model(ProjectModel::class);
        $project = $projectModel->where('slug', $slug)->first();

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        $projectCats = $projectModel->getCategories($project->id);
        $projectTags = $projectModel->getTags($project->id);

        return view('project_details', [
            'project'     => $project,
            'projectCats' => $projectCats,
            'projectTags' => $projectTags,
        ]);
    }

    public function articles()
    {
        $articleModel = model(ArticleModel::class);
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

        $allCategories = model('CategoryModel')->orderBy('name', 'ASC')->findAll();
        $allTags       = model('TagModel')->orderBy('name', 'ASC')->findAll();

        return view('articles', [
            'articles'   => $articles,
            'categories' => $allCategories,
            'tags'       => $allTags,
            'pager'      => $articleModel->pager,
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

        return view('article_details', [
            'article'     => $article,
            'categories'  => $categories,
            'tags'        => $tags,
            'articleCats' => $articleCats,
            'articleTags' => $articleTags,
            'recentPosts' => $recentPosts,
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
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $email = \Config\Services::email();
            $email->setFrom($this->request->getPost('email'), $this->request->getPost('name'));
            $email->setTo(setting('site_email') ?? 'contact@obydullah.com');
            $email->setSubject('Contact Form: ' . $this->request->getPost('subject'));
            $email->setMessage($this->request->getPost('message'));

            if ($email->send()) {
                return redirect()->to('/contact')->with('message', 'Your message has been sent. Thank you!');
            }

            return redirect()->back()->with('error', 'Failed to send message. Please try again.');
        }

        return view('contact');
    }

    public function faq()
    {
        return view('faq');
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
