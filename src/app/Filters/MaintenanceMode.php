<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class MaintenanceMode implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = $request->getUri()->getPath();

        $skipPaths = ['/user-login', '/user-register', '/userForgot-password'];
        foreach ($skipPaths as $path) {
            if (strpos($uri, $path) === 0) {
                return;
            }
        }

        $settingsModel = model('SettingsModel');
        $setting = $settingsModel->where('key', 'maintenance_mode')->first();

        if ($setting && $setting->value === '1') {
            if (auth()->loggedIn()) {
                $user = auth()->user();
                if ($user->can('admin.access')) {
                    return;
                }
            }

            $response = service('response');
            $response->setStatusCode(503);
            $response->setBody(view('maintenance'));

            return $response;
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
