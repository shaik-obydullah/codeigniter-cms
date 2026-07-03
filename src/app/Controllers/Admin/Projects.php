<?php

namespace App\Controllers\Admin;

use App\Models\ProjectModel;

class Projects extends BaseController
{
    public function index()
    {
        $projects = model(ProjectModel::class)->orderBy('created_at', 'DESC')->paginate(15);

        return $this->adminView('projects', [
            'pageTitle' => 'Projects',
            'projects'  => $projects,
            'pager'     => model(ProjectModel::class)->pager,
        ]);
    }

    public function create()
    {
        $technologies = model('TechnologyModel')->findAll();

        return $this->adminView('project-add', [
            'pageTitle'    => 'New Project',
            'technologies' => $technologies,
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
            'description'      => $this->request->getPost('description'),
            'excerpt'          => $this->request->getPost('excerpt'),
            'url'              => $this->request->getPost('url'),
            'featured_image'   => $this->request->getPost('featured_image'),
            'status'           => $this->request->getPost('status') ?? 'draft',
            'published_at'     => $this->request->getPost('published_at'),
            'meta_title'       => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
        ]);

        $projectId = $projectModel->getInsertID();

        $technologies = $this->request->getPost('technologies');
        if (is_array($technologies)) {
            $projectModel->syncTechnologies($projectId, $technologies);
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

        $technologies        = model('TechnologyModel')->findAll();
        $projectTechnologies = $projectModel->getTechnologies($id);

        $selectedTechnologies = array_map(function ($tech) {
            return $tech->id;
        }, $projectTechnologies);

        return $this->adminView('project-add', [
            'pageTitle'          => 'Edit Project',
            'editProject'        => $project,
            'technologies'       => $technologies,
            'projectTechnologies' => $selectedTechnologies,
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

        $projectModel->update($id, [
            'title'            => $this->request->getPost('title'),
            'slug'             => $this->request->getPost('slug'),
            'description'      => $this->request->getPost('description'),
            'excerpt'          => $this->request->getPost('excerpt'),
            'url'              => $this->request->getPost('url'),
            'featured_image'   => $this->request->getPost('featured_image'),
            'status'           => $this->request->getPost('status') ?? 'draft',
            'published_at'     => $this->request->getPost('published_at'),
            'meta_title'       => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
        ]);

        $technologies = $this->request->getPost('technologies');
        if (is_array($technologies)) {
            $projectModel->syncTechnologies($id, $technologies);
        }

        $this->activityModel->log(
            auth()->id(),
            'project.updated',
            'Updated project ' . $project->title,
            'projects',
            $id
        );

        return redirect()->to('/dashboard/projects')->with('message', 'Project updated successfully.');
    }

    public function delete(int $id)
    {
        $projectModel = model(ProjectModel::class);
        $project      = $projectModel->find($id);

        if (!$project) {
            return redirect()->back()->with('error', 'Project not found.');
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
