<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Login Function
$routes->get('/login', 'Login::index');
$routes->post('/Login/auth', 'Login::auth');
$routes->get('/Login/logout', 'Login::logout');

// UbahPassword Function
$routes->get('/UbahPassword', 'UbahPassword::index');
$routes->post('/UbahPassword/ubah', 'UbahPassword::ubah');

// Dashboard Function
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/Dashboard', 'Dashboard::index');

// DaftarBarang
$routes->get('/DaftarBarang', 'DaftarBarang::index');
$routes->get('/DaftarBarang/tambahBarang', 'DaftarBarang::tambahBarang');
$routes->post('/DaftarBarang/tambahBarang', 'DaftarBarang::tambahBarang');

$routes->get('/DaftarBarang/ubahBarang/(:any)', 'DaftarBarang::ubahBarang/$1');
$routes->post('/DaftarBarang/ubahbarang/(:any)', 'DaftarBarang::ubahBarang/$1');

$routes->get('/DaftarBarang/hapusBarang/(:any)', 'DaftarBarang::hapusBarang/$1');

// Data Pegawai
$routes->get('/Pegawai', 'Pegawai::index');
$routes->get('/Pegawai/tambah', 'Pegawai::tambah');
$routes->post('/Pegawai/tambah', 'Pegawai::tambah');
$routes->get('/Pegawai/edit/(:any)', 'Pegawai::edit/$1');
$routes->post('/Pegawai/edit/(:any)', 'Pegawai::edit/$1');
$routes->get('/Pegawai/hapus/(:any)', 'Pegawai::hapus/$1');

// $routes->setAutoRoute(true);
