<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function about()
    {
        return view('about');
    }

    public function projects()
    {
        return view('projects');
    }

    public function projectDetails($slug = null)
    {
        return view('project_details');
    }

    public function articles()
    {
        return view('articles');
    }

    public function articleDetails($slug = null)
    {
        return view('article_details');
    }

    public function contact()
    {
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
