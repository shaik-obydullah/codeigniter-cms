<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Shield\Config\AuthRoutes as ShieldAuthRoutes;

class AuthRoutes extends ShieldAuthRoutes
{
    public array $routes = [
        'register' => [
            [
                'get',
                'user-register',
                'RegisterController::registerView',
                'register',
            ],
            [
                'post',
                'user-register',
                'RegisterController::registerAction',
            ],
        ],
        'login' => [
            [
                'get',
                'user-login',
                'LoginController::loginView',
                'login',
            ],
            [
                'post',
                'user-login',
                'LoginController::loginAction',
            ],
        ],
        'magic-link' => [
            [
                'get',
                'user-login/magic-link',
                'MagicLinkController::loginView',
                'magic-link',
            ],
            [
                'post',
                'user-login/magic-link',
                'MagicLinkController::loginAction',
            ],
            [
                'get',
                'user-login/verify-magic-link',
                'MagicLinkController::verify',
                'verify-magic-link',
            ],
        ],
        'logout' => [
            [
                'get',
                'logout',
                'LoginController::logoutAction',
                'logout',
            ],
        ],
        'auth-actions' => [
            [
                'get',
                'auth/a/show',
                'ActionController::show',
                'auth-action-show',
            ],
            [
                'post',
                'auth/a/handle',
                'ActionController::handle',
                'auth-action-handle',
            ],
            [
                'post',
                'auth/a/verify',
                'ActionController::verify',
                'auth-action-verify',
            ],
        ],
    ];
}
