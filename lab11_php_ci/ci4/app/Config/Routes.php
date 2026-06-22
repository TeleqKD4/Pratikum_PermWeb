<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */


$routes->get('/', 'Page::index');
$routes->get('/about',   'Page::about');
$routes->get('/contact', 'Page::contact');


$routes->get('/artikel',            'Artikel::index');
$routes->get('/artikel/(:any)',     'Artikel::view/$1');

$routes->resource('post');

$routes->get('/user/login',  'User::login');
$routes->post('/user/login', 'User::login');
$routes->get('/user/logout', 'User::logout');

$routes->get('/ajax', 'AjaxController::index');
$routes->get('/ajax/getData', 'AjaxController::getData');
$routes->post('/ajax/delete/(:num)', 'AjaxController::delete/$1');

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/',                     'Artikel::admin_index');
    $routes->get('artikel',               'Artikel::admin_index');
    $routes->get('artikel/add',           'Artikel::add');
    $routes->add('artikel/add',           'Artikel::add');
    $routes->add('artikel/edit/(:any)',   'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
});

$routes->group('api', function($routes) {
    
    // 1. Tangkap request pemanasan (OPTIONS) dari browser VueJS
    $routes->options('login', static function() {
        $response = \Config\Services::response();
        $response->setHeader('Access-Control-Allow-Origin', '*');
        $response->setHeader('Access-Control-Allow-Headers', 'Authorization, Content-Type');
        $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
        return $response->setStatusCode(200);
    });

    // 2. Route utama untuk proses login
    $routes->post('login', '\App\Controllers\Api\Auth::login');
    
});