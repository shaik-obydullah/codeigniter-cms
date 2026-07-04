<?php

namespace App\Controllers\Admin;

use App\Models\ArticleModel;

class Articles extends BaseController
{
    public function index()
    {
        $status = $this->request->getGet('status');
        $search = $this->request->getGet('search');

        $model = model(ArticleModel::class);

        if ($status && in_array($status, ['published', 'draft', 'scheduled'])) {
            $model->where('status', $status);
        }

        if ($search) {
            $model->groupStart()
                ->like('title', $search)
                ->orLike('content', $search)
                ->groupEnd();
        }

        $articles = $model->orderBy('created_at', 'DESC')->paginate(15);

        $pager = $model->pager;
        $pager->only(['status', 'search']);

        return $this->adminView('articles', [
            'pageTitle'     => 'Articles',
            'articles'      => $articles,
            'pager'         => $pager,
            'currentStatus' => $status,
            'search'        => $search,
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

        $featuredImage = $this->handleFeaturedImageUpload();

        $articleModel->insert([
            'user_id'          => auth()->id(),
            'title'            => $this->request->getPost('title'),
            'slug'             => $this->request->getPost('slug'),
            'content'          => $this->request->getPost('content'),
            'excerpt'          => $this->request->getPost('excerpt'),
            'featured_image'   => $featuredImage,
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

        return redirect()->to('/dashboard/articles')->with('message', 'Article created successfully.');
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

        $featuredImage = $this->handleFeaturedImageUpload();

        if (!$featuredImage) {
            $file = $this->request->getFile('featured_image');
            $existing = $this->request->getPost('existing_featured_image');

            if ($file && !$file->isValid() && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                $featuredImage = $article->featured_image;
            } else {
                $featuredImage = $existing !== '' ? $existing : null;
            }
        }

        if ($article->featured_image && $featuredImage !== $article->featured_image) {
            $oldPath = FCPATH . $article->featured_image;
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $articleModel->update($id, [
            'title'            => $this->request->getPost('title'),
            'slug'             => $this->request->getPost('slug'),
            'content'          => $this->request->getPost('content'),
            'excerpt'          => $this->request->getPost('excerpt'),
            'featured_image'   => $featuredImage,
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

        return redirect()->to('/dashboard/articles')->with('message', 'Article updated successfully.');
    }

    private function handleFeaturedImageUpload(): ?string
    {
        $file = $this->request->getFile('featured_image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (str_starts_with($file->getMimeType(), 'image/') && $file->getSizeByUnit('mb') <= 2) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads/articles', $newName);
                return 'uploads/articles/' . $newName;
            }
        }

        return null;
    }

    public function delete(int $id)
    {
        $articleModel = model(ArticleModel::class);
        $article      = $articleModel->find($id);

        if (!$article) {
            return redirect()->back()->with('error', 'Article not found.');
        }

        if ($article->featured_image) {
            $path = FCPATH . $article->featured_image;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $articleModel->delete($id);

        $this->activityModel->log(
            auth()->id(),
            'article.deleted',
            'Deleted article ' . $article->title,
            'articles',
            $id
        );

        return redirect()->to('/dashboard/articles')->with('message', 'Article deleted successfully.');
    }
}
