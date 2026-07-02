<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\ProjectModel;
use App\Models\SkillModel;

class Home extends BaseController
{
    public function index()
    {
        $skills   = model(SkillModel::class)->orderBy('name', 'ASC')->findAll();
        $projects = model(ProjectModel::class)->where('status', 'published')->orderBy('created_at', 'DESC')->findAll(6);
        $articles = model(ArticleModel::class)->where('status', 'published')->orderBy('created_at', 'DESC')->findAll(6);

        $projectTechnologies = [];
        foreach ($projects as $project) {
            $projectTechnologies[$project->id] = model(ProjectModel::class)->getTechnologies($project->id);
        }

        return view('home', [
            'skills'              => $skills,
            'projects'            => $projects,
            'projectTechnologies' => $projectTechnologies,
            'articles'            => $articles,
        ]);
    }
}
