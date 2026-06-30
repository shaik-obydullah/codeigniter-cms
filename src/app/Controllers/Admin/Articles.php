<?php

namespace App\Controllers\Admin;

use App\Models\ArticleModel;

class Articles extends BaseController
{
    public function index()
    {
        $articles = model(ArticleModel::class)->orderBy('created_at', 'DESC')->paginate(15);

        return $this->adminView('articles', [
            'pageTitle' => 'Articles',
            'articles'  => $articles,
            'pager'     => model(ArticleModel::class)->pager,
        ]);
    }

    public function create()
    {
        $categories = model('CategoryModel')->findAll();
        $tags       = model('TagModel')->findAll();

        return $this->adminView('article-add', [
            'pageTitle'  => 'New Article',
            'categories' => $categories,
            'tags'       => $tags,
        ]);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|min_length[3]',
            'slug'  => 'required|is_unique[articles.slug]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $articleModel = model(ArticleModel::class);

        $articleModel->insert([
            'user_id'          => auth()->id(),
            'title'            => $this->request->getPost('title'),
            'slug'             => $this->request->getPost('slug'),
            'content'          => $this->request->getPost('content'),
            'excerpt'          => $this->request->getPost('excerpt'),
            'featured_image'   => $this->request->getPost('featured_image'),
            'status'           => $this->request->getPost('status') ?? 'draft',
            'published_at'     => $this->request->getPost('published_at'),
            'meta_title'       => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
        ]);

        $articleId = $articleModel->getInsertID();

        $categories = $this->request->getPost('categories');
        if (is_array($categories)) {
            $articleModel->syncCategories($articleId, $categories);
        }

        $tags = $this->request->getPost('tags');
        if (is_array($tags)) {
            $articleModel->syncTags($articleId, $tags);
        }

        $this->activityModel->log(
            auth()->id(),
            'article.created',
            'Created article ' . $this->request->getPost('title'),
            'articles',
            $articleId
        );

        return redirect()->to('/admin/articles')->with('message', 'Article created successfully.');
    }

    public function edit(int $id)
    {
        $articleModel = model(ArticleModel::class);
        $article      = $articleModel->find($id);

        if (!$article) {
            return redirect()->back()->with('error', 'Article not found.');
        }

        $categories    = model('CategoryModel')->findAll();
        $tags          = model('TagModel')->findAll();
        $articleCats   = $articleModel->getCategories($id);
        $articleTags   = $articleModel->getTags($id);

        $selectedCategories = array_map(function ($cat) {
            return $cat->id;
        }, $articleCats);

        $selectedTags = array_map(function ($tag) {
            return $tag->id;
        }, $articleTags);

        return $this->adminView('article-add', [
            'pageTitle'        => 'Edit Article',
            'editArticle'      => $article,
            'categories'       => $categories,
            'tags'             => $tags,
            'articleCategories' => $selectedCategories,
            'articleTags'      => $selectedTags,
        ]);
    }

    public function update(int $id)
    {
        $articleModel = model(ArticleModel::class);
        $article      = $articleModel->find($id);

        if (!$article) {
            return redirect()->back()->with('error', 'Article not found.');
        }

        $rules = [
            'title' => 'required|min_length[3]',
            'slug'  => "required|is_unique[articles.slug,id,{$id}]",
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $articleModel->update($id, [
            'title'            => $this->request->getPost('title'),
            'slug'             => $this->request->getPost('slug'),
            'content'          => $this->request->getPost('content'),
            'excerpt'          => $this->request->getPost('excerpt'),
            'featured_image'   => $this->request->getPost('featured_image'),
            'status'           => $this->request->getPost('status') ?? 'draft',
            'published_at'     => $this->request->getPost('published_at'),
            'meta_title'       => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
        ]);

        $categories = $this->request->getPost('categories');
        if (is_array($categories)) {
            $articleModel->syncCategories($id, $categories);
        }

        $tags = $this->request->getPost('tags');
        if (is_array($tags)) {
            $articleModel->syncTags($id, $tags);
        }

        $this->activityModel->log(
            auth()->id(),
            'article.updated',
            'Updated article ' . $article->title,
            'articles',
            $id
        );

        return redirect()->to('/admin/articles')->with('message', 'Article updated successfully.');
    }

    public function delete(int $id)
    {
        $articleModel = model(ArticleModel::class);
        $article      = $articleModel->find($id);

        if (!$article) {
            return redirect()->back()->with('error', 'Article not found.');
        }

        $articleModel->delete($id);

        $this->activityModel->log(
            auth()->id(),
            'article.deleted',
            'Deleted article ' . $article->title,
            'articles',
            $id
        );

        return redirect()->to('/admin/articles')->with('message', 'Article deleted successfully.');
    }
}
