<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');
$routes->get('/about', 'Pages::about');
$routes->get('/projects', 'Pages::projects');
$routes->get('/projects/(:any)', 'Pages::projectDetails/$1');
$routes->get('/articles', 'Pages::articles');
$routes->get('/articles/(:any)', 'Pages::articleDetails/$1');
$routes->get('/contact', 'Pages::contact');
$routes->get('/faq', 'Pages::faq');
$routes->get('/privacy', 'Pages::privacy');
$routes->get('/terms', 'Pages::terms');

service('auth')->routes($routes);
