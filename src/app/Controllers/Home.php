<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\ProjectModel;
use App\Models\SkillModel;

class Home extends BaseController
{
    public function index()
    {
        $skills   = model(SkillModel::class)->orderBy('serial', 'ASC')->orderBy('name', 'ASC')->findAll();
        $projects = model(ProjectModel::class)->where('status', 'published')->orderBy('created_at', 'DESC')->findAll(6);
        $articles = model(ArticleModel::class)->where('status', 'published')->orderBy('created_at', 'DESC')->findAll(6);

        if (!empty($projects)) {
            $projectIds = array_map(function ($p) {
                return $p->id;
            }, $projects);
            $projectCats = model(ProjectModel::class)->getCategoriesForProjects($projectIds);
            $projectTags = model(ProjectModel::class)->getTagsForProjects($projectIds);
            foreach ($projects as $p) {
                $p->category_name = $projectCats[$p->id] ?? '';
                $p->tags_str      = $projectTags[$p->id] ?? '';
            }
        }

        if (!empty($articles)) {
            $articleIds = array_map(function ($a) {
                return $a->id;
            }, $articles);
            $articleCats = model(ArticleModel::class)->getCategoriesForArticles($articleIds);
            $articleTags = model(ArticleModel::class)->getTagsForArticles($articleIds);
            foreach ($articles as $a) {
                $a->category_name = $articleCats[$a->id] ?? '';
                $a->tags_str      = $articleTags[$a->id] ?? '';
            }
        }

        $allCategories = model('CategoryModel')->orderBy('name', 'ASC')->findAll();
        $allTags       = model('TagModel')->orderBy('name', 'ASC')->findAll();

        return view('home', [
            'skills'     => $skills,
            'projects'   => $projects,
            'articles'   => $articles,
            'categories' => $allCategories,
            'tags'       => $allTags,
        ]);
    }
}
