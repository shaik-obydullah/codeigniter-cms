<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

/** Website */
$routes->get('/', 'Home::index');
$routes->get('/who-am-i', 'Home::who_am_i');
$routes->get('articles', 'Home::articles');
$routes->get('article/(:segment)', 'Home::article/$1');
$routes->get('projects', 'Home::projects');
$routes->get('project/(:segment)', 'Home::project/$1');
$routes->post('contact-me', 'Home::contact_me');
$routes->get('privacy-policy', 'Home::privacy_policy');
$routes->get('documentation/wordpress-restaurant-pos-lite-plugin', 'Documentation::wordpress_restaurant_pos_lite_plugin');
$routes->get('documentation/lime-css-framework', 'Documentation::lime_css_framework');

/** Dashboard - Auth */
$routes->get('logout', 'LoginController::logout');

$routes->group('', ['filter' => 'guest'], function ($routes) {
    $routes->get('login', 'LoginController::index');
    $routes->post('auth', 'LoginController::auth');
});

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');

    $routes->get('namaz', 'NamazController::index');

    $routes->get('wallet', 'WalletController::index');
    $routes->post('wallet/create', 'WalletController::create');
    $routes->post('wallet/update/(:num)', 'WalletController::update/$1');
    $routes->delete('wallet/delete/(:num)', 'WalletController::delete/$1');

    $routes->get('income', 'IncomeController::index');
    $routes->get('income/list', 'IncomeController::list');
    $routes->post('income/create', 'IncomeController::create');
    $routes->get('income/select/(:num)', 'IncomeController::select/$1');
    $routes->post('income/update/(:num)', 'IncomeController::update/$1');
    $routes->delete('income/delete/(:num)', 'IncomeController::delete/$1');

    $routes->get('expense', 'ExpenseController::index');
    $routes->get('expense/list', 'ExpenseController::list');
    $routes->post('expense/create', 'ExpenseController::create');
    $routes->get('expense/select/(:num)', 'ExpenseController::select/$1');
    $routes->post('expense/update/(:num)', 'ExpenseController::update/$1');
    $routes->delete('expense/delete/(:num)', 'ExpenseController::delete/$1');

    $routes->get('cashbook', 'CashbookController::index');
    $routes->get('cashbook/list', 'CashbookController::list');

    $routes->get('message', 'MessageController::index');
    $routes->get('message/list', 'MessageController::list');
    $routes->post('message/update/(:num)', 'MessageController::update/$1');
    $routes->delete('message/delete/(:num)', 'MessageController::delete/$1');

    $routes->get('media-library', 'MediaController::index');
    $routes->get('media/list', 'MediaController::list');
    $routes->post('media/create', 'MediaController::create');
    $routes->post('media/update/(:num)', 'MediaController::update/$1');
    $routes->delete('media/delete/(:num)', 'MediaController::delete/$1');

    $routes->get('tag', 'TagController::index');
    $routes->get('tag/list', 'TagController::list');
    $routes->post('tag/create', 'TagController::create');
    $routes->get('tag/select/(:num)', 'TagController::select/$1');
    $routes->post('tag/update/(:num)', 'TagController::update/$1');
    $routes->delete('tag/delete/(:num)', 'TagController::delete/$1');

    $routes->get('dashboard/article', 'ArticleController::index');
    $routes->get('dashboard/article/list', 'ArticleController::list');
    $routes->get('tag/search', 'TagController::search');
    $routes->get('dashboard/article/add', 'ArticleController::add');
    $routes->post('dashboard/article/create', 'ArticleController::create');
    $routes->get('dashboard/article/select/(:num)', 'ArticleController::select/$1');
    $routes->post('dashboard/article/update', 'ArticleController::update');
    $routes->delete('dashboard/article/delete/(:num)', 'ArticleController::delete/$1');

    $routes->get('dashboard/project', 'ProjectController::index');
    $routes->get('dashboard/project/list', 'ProjectController::list');
    $routes->get('dashboard/project/add', 'ProjectController::add');
    $routes->post('dashboard/project/create', 'ProjectController::create');
    $routes->get('dashboard/project/select/(:num)', 'ProjectController::select/$1');
    $routes->post('dashboard/project/update', 'ProjectController::update');
    $routes->delete('dashboard/project/delete/(:num)', 'ProjectController::delete/$1');

    $routes->get('activity', 'ActivityController::index');
    $routes->get('activity/list', 'ActivityController::list');

    $routes->get('setting', 'DashboardController::setting');
    $routes->get('getSetting', 'DashboardController::get_setting');
    $routes->post('setting/save', 'DashboardController::save_setting');
});

service('auth')->routes($routes);
