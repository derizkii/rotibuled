<?php

use Config\Services;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

$routes->get('/', 'Login::index', ['filter' => 'noauth']);
$routes->post('login/validasi', 'Login::masuk');
$routes->match(['get', 'post'], '/login/masuk', 'Login::masuk', ['filter' => 'noauth']);
$routes->get('/logout', 'Login::keluar', ['filter' => 'auth']);

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

$routes->get('/users', 'Users::index', ['filter' => 'auth']);
$routes->get('/users/add', 'Users::tambah', ['filter' => 'auth']);
$routes->post('/users/save', 'Users::simpan', ['filter' => 'auth']);
$routes->get('/users/(:segment)', 'Users::detail/$1', ['filter' => 'auth']);
$routes->get('/users/edit/(:segment)', 'Users::ubah/$1', ['filter' => 'auth']);
$routes->post('/users/update/(:segment)', 'Users::ubah_data/$1', ['filter' => 'auth']);
$routes->get('/users/delete/(:segment)', 'Users::hapus/$1', ['filter' => 'auth']);
$routes->post('/users/delete/(:segment)', 'Users::hapus_data/$1', ['filter' => 'auth']);
$routes->post('/users/searching', 'Users::pencarian', ['filter' => 'auth']);
$routes->get('/users/search/(:segment)', 'Users::cari/$1', ['filter' => 'auth']);

// Items (converted from Product)
$routes->get('/items', 'Items::index', ['filter' => 'auth']);
$routes->get('/items/create', 'Items::tambah', ['filter' => 'auth']);
$routes->post('/items/store', 'Items::simpan', ['filter' => 'auth']);
$routes->get('/items/(:segment)', 'Items::detail/$1', ['filter' => 'auth']);
$routes->get('/items/edit/(:segment)', 'Items::ubah/$1', ['filter' => 'auth']);
$routes->post('/items/update/(:segment)', 'Items::ubah_data/$1', ['filter' => 'auth']);
$routes->post('/items/delete/(:segment)', 'Items::hapus_data/$1', ['filter' => 'auth']);
$routes->post('/items/searching', 'Items::pencarian', ['filter' => 'auth']);
$routes->get('/items/search/(:segment)', 'Items::cari/$1', ['filter' => 'auth']);

// Removed sales/cart routes (POS removed)

$routes->get('/report', 'Laporan::index', ['filter' => 'auth']);
$routes->post('/report', 'Laporan::index', ['filter' => 'auth']);
$routes->get('/report/day/(:segment)', 'Laporan::cetak_hari/$1', ['filter' => 'auth']);
$routes->get('/report/print/(:segment)/(:segment)', 'Laporan::cetak/$1/$2', ['filter' => 'auth']);

// Stok Harian
$routes->get('/stok-harian', 'StockHarianController::index', ['filter' => 'auth']);
$routes->get('/stok-harian/create', 'StockHarianController::create', ['filter' => 'auth']);
$routes->post('/stok-harian/store', 'StockHarianController::store', ['filter' => 'auth']);
$routes->get('/stok-harian/rekap/(:segment)', 'StockHarianController::perTanggal/$1', ['filter' => 'auth']);

// Laporan Stok
$routes->get('/laporan-stok/export-pdf', 'LaporanStokController::exportPdf', ['filter' => 'auth']);
$routes->get('/laporan-stok', 'LaporanStokController::index', ['filter' => 'auth']);
$routes->post('/laporan-stok', 'LaporanStokController::index', ['filter' => 'auth']);
$routes->get('/laporan-stok/(:segment)', 'LaporanStokController::index/$1', ['filter' => 'auth']);

// Rekap Harian alias laporan-stok
$routes->get('/rekap-harian', 'LaporanStokController::index', ['filter' => 'auth']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to override any defaults in this file. Environment-based routes
 * is one such time. require() additional route files here to make
 * that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
