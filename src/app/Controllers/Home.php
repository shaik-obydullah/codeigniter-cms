<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to('login');
        }

        $user = auth()->user();

        return 'Hello World, ' . $user->email;
    }
}
