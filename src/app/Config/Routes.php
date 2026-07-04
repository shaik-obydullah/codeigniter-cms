<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');
$routes->get('/about', 'Pages::about');
$routes->get('/projects', 'Pages::projects');
$routes->get('/projects/(:any)', 'Pages::projectDetails/$1');
$routes->get('/articles', 'Pages::articles');
$routes->get('/articles/(:any)', 'Pages::articleDetails/$1');
$routes->match(['get', 'post'], '/contact', 'Pages::contact');
$routes->get('/faq', 'Pages::faq');
$routes->get('/privacy', 'Pages::privacy');
$routes->get('/terms', 'Pages::terms');

service('auth')->routes($routes);

$routes->group('/dashboard', ['filter' => 'admin-access'], static function ($routes) {
    $routes->get('', '\App\Controllers\Admin\Dashboard::index');

    $routes->get('users', '\App\Controllers\Admin\Users::index');
    $routes->get('users/create', '\App\Controllers\Admin\Users::create');
    $routes->post('users', '\App\Controllers\Admin\Users::store');
    $routes->get('users/(:num)/edit', '\App\Controllers\Admin\Users::edit/$1');
    $routes->post('users/(:num)', '\App\Controllers\Admin\Users::update/$1');
    $routes->post('users/(:num)/delete', '\App\Controllers\Admin\Users::delete/$1');

    $routes->get('roles', '\App\Controllers\Admin\Roles::index');
    $routes->post('roles', '\App\Controllers\Admin\Roles::update');

    $routes->get('notifications', '\App\Controllers\Admin\Notifications::index');
    $routes->post('notifications/(:num)/read', '\App\Controllers\Admin\Notifications::markRead/$1');
    $routes->post('notifications/read-all', '\App\Controllers\Admin\Notifications::markAllRead');

    $routes->get('activities', '\App\Controllers\Admin\Activities::index');

    $routes->get('articles', '\App\Controllers\Admin\Articles::index');
    $routes->get('articles/create', '\App\Controllers\Admin\Articles::create');
    $routes->post('articles', '\App\Controllers\Admin\Articles::store');
    $routes->get('articles/(:num)/edit', '\App\Controllers\Admin\Articles::edit/$1');
    $routes->match(['post', 'put'], 'articles/(:num)', '\App\Controllers\Admin\Articles::update/$1');
    $routes->post('articles/(:num)/delete', '\App\Controllers\Admin\Articles::delete/$1');

    $routes->get('projects', '\App\Controllers\Admin\Projects::index');
    $routes->get('projects/create', '\App\Controllers\Admin\Projects::create');
    $routes->post('projects', '\App\Controllers\Admin\Projects::store');
    $routes->get('projects/(:num)/edit', '\App\Controllers\Admin\Projects::edit/$1');
    $routes->match(['post', 'put'], 'projects/(:num)', '\App\Controllers\Admin\Projects::update/$1');
    $routes->post('projects/(:num)/delete', '\App\Controllers\Admin\Projects::delete/$1');

    $routes->get('categories', '\App\Controllers\Admin\Categories::index');
    $routes->post('categories', '\App\Controllers\Admin\Categories::store');
    $routes->post('categories/(:num)', '\App\Controllers\Admin\Categories::update/$1');
    $routes->post('categories/(:num)/delete', '\App\Controllers\Admin\Categories::delete/$1');

    $routes->get('tags', '\App\Controllers\Admin\Tags::index');
    $routes->post('tags', '\App\Controllers\Admin\Tags::store');
    $routes->post('tags/(:num)', '\App\Controllers\Admin\Tags::update/$1');
    $routes->post('tags/(:num)/delete', '\App\Controllers\Admin\Tags::delete/$1');

    $routes->get('comments', '\App\Controllers\Admin\Comments::index');
    $routes->post('comments/(:num)/approve', '\App\Controllers\Admin\Comments::approve/$1');
    $routes->post('comments/(:num)/delete', '\App\Controllers\Admin\Comments::delete/$1');

    $routes->get('site-settings', '\App\Controllers\Admin\SiteSettings::index');
    $routes->post('site-settings', '\App\Controllers\Admin\SiteSettings::update');

    $routes->get('skills', '\App\Controllers\Admin\Skills::index');
    $routes->post('skills', '\App\Controllers\Admin\Skills::store');
    $routes->post('skills/(:num)', '\App\Controllers\Admin\Skills::update/$1');
    $routes->post('skills/(:num)/delete', '\App\Controllers\Admin\Skills::delete/$1');

    $routes->get('media', '\App\Controllers\Admin\Media::index');
    $routes->post('media/upload', '\App\Controllers\Admin\Media::upload');
    $routes->post('media/(:num)/delete', '\App\Controllers\Admin\Media::delete/$1');
    $routes->get('media/browse', '\App\Controllers\Admin\Media::browse');
});
