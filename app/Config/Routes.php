<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Auth
$routes->get('register', 'Auth::RegisterForm');
$routes->post('register/proses', 'Auth::RegisterProses');
$routes->get('login', 'Auth::LoginForm');
$routes->post('login/proses', 'Auth::LoginProses');
$routes->get('forbidden', 'Auth::Forbidden');

// User Group
$routes->group('user', ['filter' => 'role:pelanggan'], function ($routes) {
    $routes->get('home', 'Pelanggan\Pages::index');
    
    // Komplaint
    $routes->get('komplaint/buat', 'Pelanggan\Pages::ComplaintForm');
    $routes->post('komplaint/buat', 'Pelanggan\Pages::ComplaintStore');
    // list
    $routes->get('komplaint/list', 'Pelanggan\Pages::ComplaintList');
    // edit
    $routes->get('komplaint/edit/(:num)', 'Pelanggan\Pages::ComplaintEdit/$1');
    // Hapus
    $routes->post('Komplaint/delete', 'Pelanggan\Pages::ComplainDelete');
    // detail
    $routes->get('komplaint/detail','pelanggan\Pages::ComplainDetail');

    // Logout
    $routes->get('logout', 'Pelanggan\Pages::Logout');
});
// Admin Group
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('dashboard', 'Admin\Pages::dashboard');
    $routes->get('tanggapan', 'Admin\Pages::tanggapan');
    $routes->get('komplaint', 'Admin\Pages::komplaint');
    $routes->get('profil', 'Admin\Pages::profil');
    

    // Logout
    $routes->get('logout', 'Pelanggan\Pages::Logout');
});