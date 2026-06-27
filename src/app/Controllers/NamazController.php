<?php
namespace App\Controllers;

class NamazController extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Namaz Schedule',
        ];

        $data['content'] = view('namaz/index', $data);
        return view('dashboard/master', $data);
    }
}