<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('/daftar', 'Login::register');
$routes->post('/daftar/proses', 'Login::prosesregister');
$routes->get('/logout', 'Login::logout');
$routes->post('/login/proses', 'Login::proses');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/ubahpassword', 'ManajemenAkun::ubahpassword');
$routes->post('/ubahpassword/prosesubahpassword', 'ManajemenAkun::prosesubahpassword');

//ROUTE PEMINJAMAN
$routes->get('/peminjaman', 'Peminjaman::index');
$routes->post('/peminjaman/tambah', 'Peminjaman::tambah');
$routes->post('/peminjaman/pengembalian', 'Peminjaman::pengembalian');
$routes->get('/peminjaman/validasi/(:any)', 'Peminjaman::validasi/$1');
$routes->get('/peminjaman/tidakvalidasi/(:any)', 'Peminjaman::tidakvalidasi/$1');
$routes->post('/controller/get_data_by_id', 'Peminjaman::getDataById');
$routes->get('/peminjaman/detail/(:any)', 'Peminjaman::detail/$1');
$routes->get('/peminjaman/cetakpeminjaman/(:any)', 'Peminjaman::pdfpeminjaman/$1');
$routes->get('/peminjaman/cetakpengembalian/(:any)', 'Peminjaman::pdfpengembalian/$1');
$routes->get('/peminjaman/hapus/(:any)', 'Peminjaman::hapus/$1');

// ROUTE LAPORAN
$routes->get('/laporan', 'Laporan::index');
$routes->get('/laporan/cetaklaporan/(:any)', 'Laporan::downloadpdf/$1');
$routes->post('/laporan/tambah', 'Laporan::tambah');
$routes->post('/laporan/bayar', 'Laporan::bayar');
$routes->get('/laporan/detail/(:any)', 'Laporan::detail/$1');

//ROUTE AKUN
$routes->get('/manajemenakun', 'ManajemenAkun::index');
$routes->post('/manajemenakun/tambah', 'ManajemenAkun::tambah');
$routes->post('/manajemenakun/pengembalian', 'ManajemenAkun::pengembalian');
$routes->get('/manajemenakun/detail/(:any)', 'ManajemenAkun::detail/$1');
$routes->get('/manajemenakun/edit/(:any)', 'ManajemenAkun::edit/$1');
$routes->post('/manajemenakun/edit/proses', 'ManajemenAkun::prosesedit');
$routes->get('/manajemenakun/hapus/(:any)', 'ManajemenAkun::hapus/$1');

//ROUTE BARANG
$routes->get('/barang', 'Barang::index');
$routes->post('/barang/tambah', 'Barang::tambah');
$routes->get('/barang/hapus/(:any)', 'Barang::hapus/$1');