<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class WebsiteCache implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = $request->getUri()->getPath();

        if (strpos($uri, '/dashboard') === 0) {
            return;
        }

        $settingsModel = model('SettingsModel');
        $setting = $settingsModel->where('key', 'website_cache')->first();

        if ($setting && (int) $setting->value > 0) {
            service('responsecache')->setTtl((int) $setting->value);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
