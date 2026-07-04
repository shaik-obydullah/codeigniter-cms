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
        $projects = model(ProjectModel::class)->where('status', 'published')->orderBy('serial', 'ASC')->paginate(12);

        return view('projects', [
            'projects' => $projects,
            'pager'    => model(ProjectModel::class)->pager,
        ]);
    }

    public function projectDetails($slug = null)
    {
        $project = model(ProjectModel::class)->where('slug', $slug)->first();

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        return view('project_details', [
            'project' => $project,
        ]);
    }

    public function articles()
    {
        $articles    = model(ArticleModel::class)->where('status', 'published')->orderBy('serial', 'ASC')->paginate(12);
        $categories  = model('CategoryModel')->orderBy('name', 'ASC')->findAll();
        $tags        = model('TagModel')->orderBy('name', 'ASC')->findAll();

        return view('articles', [
            'articles'   => $articles,
            'categories' => $categories,
            'tags'       => $tags,
            'pager'      => model(ArticleModel::class)->pager,
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
