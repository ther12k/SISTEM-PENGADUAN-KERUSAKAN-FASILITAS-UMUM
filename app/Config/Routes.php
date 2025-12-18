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
    $routes->post('komplaint/delete', 'Pelanggan\Pages::ComplainDelete');
    // detail
    $routes->get('komplaint/detail','Pelanggan\Pages::ComplainDetail');
    // Profile (temporarily redirect to home)
    $routes->get('profil', 'Pelanggan\Pages::index');

    // Logout
    $routes->get('logout', 'Pelanggan\Pages::Logout');
});
// Admin Group
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('dashboard', 'Admin\Pages::dashboard');
    $routes->get('komplaint', 'Admin\Pages::komplaint');
    $routes->get('profil', 'Admin\Pages::profil');
    $routes->post('updateStatus', 'Admin\Pages::updateStatus');
    $routes->get('komplaint/detail', 'Admin\Pages::detail');
    $routes->get('getTanggapanForm', 'Admin\Pages::getTanggapanForm');
    $routes->post('saveTanggapan', 'Admin\Pages::saveTanggapan');

    // Logout
    $routes->get('logout', 'Admin\Pages::logout');
});