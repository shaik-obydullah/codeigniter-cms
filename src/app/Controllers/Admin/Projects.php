<?php

namespace App\Controllers\Admin;

use App\Models\ProjectModel;

class Projects extends BaseController
{
    public function index()
    {
        $status = $this->request->getGet('status');
        $search = $this->request->getGet('search');

        $model = model(ProjectModel::class);

        if ($status && in_array($status, ['published', 'draft'])) {
            $model->where('status', $status);
        }

        if ($search) {
            $model->groupStart()
                ->like('title', $search)
                ->orLike('description', $search)
                ->groupEnd();
        }

        $projects = $model->orderBy('serial', 'ASC')->paginate(15);

        $pager = $model->pager;
        $pager->only(['status', 'search']);

        return $this->adminView('projects', [
            'pageTitle'     => 'Projects',
            'projects'      => $projects,
            'pager'         => $pager,
            'currentStatus' => $status,
            'search'        => $search,
        ]);
    }

    public function create()
    {
        $categories = model('CategoryModel')->findAll();
        $tags       = model('TagModel')->findAll();

        return $this->adminView('project-add', [
            'pageTitle'  => 'New Project',
            'categories' => $categories,
            'tags'       => $tags,
        ]);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|min_length[3]',
            'slug'  => 'required|is_unique[projects.slug]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $projectModel = model(ProjectModel::class);

        $projectModel->insert([
            'user_id'          => auth()->id(),
            'title'            => $this->request->getPost('title'),
            'slug'             => $this->request->getPost('slug'),
            'description'      => $this->request->getPost('content'),
            'excerpt'          => $this->request->getPost('excerpt'),
            'url'              => $this->request->getPost('url'),
            'featured_image'   => $this->handleFeaturedImageUpload(),
            'status'           => $this->request->getPost('status') ?? 'draft',
            'published_at'     => $this->request->getPost('published_at'),
            'meta_title'       => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'serial'           => $this->request->getPost('serial') ?? 0,
        ]);

        $projectId = $projectModel->getInsertID();

        $categories = $this->request->getPost('categories');
        if (is_array($categories)) {
            $projectModel->syncCategories($projectId, $categories);
        }

        $tags = $this->request->getPost('tags');
        if (is_array($tags)) {
            $projectModel->syncTags($projectId, $tags);
        }

        $this->activityModel->log(
            auth()->id(),
            'project.created',
            'Created project ' . $this->request->getPost('title'),
            'projects',
            $projectId
        );

        return redirect()->to('/dashboard/projects')->with('message', 'Project created successfully.');
    }

    public function edit(int $id)
    {
        $projectModel = model(ProjectModel::class);
        $project      = $projectModel->find($id);

        if (!$project) {
            return redirect()->back()->with('error', 'Project not found.');
        }

        $categories        = model('CategoryModel')->findAll();
        $projectCategories = $projectModel->getCategories($id);
        $tags              = model('TagModel')->findAll();
        $projectTags       = $projectModel->getTags($id);

        $selectedCategories = array_map(function ($cat) {
            return $cat->id;
        }, $projectCategories);

        $selectedTags = array_map(function ($tag) {
            return $tag->id;
        }, $projectTags);

        return $this->adminView('project-add', [
            'pageTitle'         => 'Edit Project',
            'editProject'       => $project,
            'categories'        => $categories,
            'projectCategories' => $selectedCategories,
            'tags'              => $tags,
            'projectTags'       => $selectedTags,
        ]);
    }

    public function update(int $id)
    {
        $projectModel = model(ProjectModel::class);
        $project      = $projectModel->find($id);

        if (!$project) {
            return redirect()->back()->with('error', 'Project not found.');
        }

        $rules = [
            'title' => 'required|min_length[3]',
            'slug'  => "required|is_unique[projects.slug,id,{$id}]",
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $featuredImage = $this->handleFeaturedImageUpload();

        if (!$featuredImage) {
            $file = $this->request->getFile('featured_image');
            $existing = $this->request->getPost('existing_featured_image');

            if ($file && !$file->isValid() && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                $featuredImage = $project->featured_image;
            } else {
                $featuredImage = $existing !== '' ? $existing : null;
            }
        }

        if ($project->featured_image && $featuredImage !== $project->featured_image) {
            $oldPath = FCPATH . $project->featured_image;
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $projectModel->update($id, [
            'title'            => $this->request->getPost('title'),
            'slug'             => $this->request->getPost('slug'),
            'description'      => $this->request->getPost('content'),
            'excerpt'          => $this->request->getPost('excerpt'),
            'url'              => $this->request->getPost('url'),
            'featured_image'   => $featuredImage,
            'status'           => $this->request->getPost('status') ?? 'draft',
            'published_at'     => $this->request->getPost('published_at'),
            'meta_title'       => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'serial'           => $this->request->getPost('serial') ?? 0,
        ]);

        $projectModel->syncCategories(
            $id,
            $this->request->getPost('categories') ?? []
        );

        $projectModel->syncTags(
            $id,
            $this->request->getPost('tags') ?? []
        );

        $this->activityModel->log(
            auth()->id(),
            'project.updated',
            'Updated project ' . $project->title,
            'projects',
            $id
        );

        return redirect()->to('/dashboard/projects')->with('message', 'Project updated successfully.');
    }

    private function handleFeaturedImageUpload(): ?string
    {
        $file = $this->request->getFile('featured_image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (str_starts_with($file->getMimeType(), 'image/') && $file->getSizeByUnit('mb') <= 2) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads/projects', $newName);
                return 'uploads/projects/' . $newName;
            }
        }

        return null;
    }

    public function delete(int $id)
    {
        $projectModel = model(ProjectModel::class);
        $project      = $projectModel->find($id);

        if (!$project) {
            return redirect()->back()->with('error', 'Project not found.');
        }

        if ($project->featured_image) {
            $path = FCPATH . $project->featured_image;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $projectModel->delete($id);

        $this->activityModel->log(
            auth()->id(),
            'project.deleted',
            'Deleted project ' . $project->title,
            'projects',
            $id
        );

        return redirect()->to('/dashboard/projects')->with('message', 'Project deleted successfully.');
    }
}
