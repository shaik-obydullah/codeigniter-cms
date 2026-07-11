<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAccess implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!auth()->loggedIn()) {
            return redirect()->to('/user-login');
        }

        $user = auth()->user();

        if ($arguments !== null) {
            foreach ($arguments as $permission) {
                if (!$user->can($permission)) {
                    return redirect()->back()->with('error', lang('Auth.notEnoughPrivilege'));
                }
            }
        } elseif (!$user->can('admin.access')) {
            return redirect()->back()->with('error', lang('Auth.notEnoughPrivilege'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
