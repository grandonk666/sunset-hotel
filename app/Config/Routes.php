<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Hotel');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Hotel::index');
$routes->post('/rooms', 'Hotel::rooms');
$routes->get('/rooms', 'Hotel::rooms');
$routes->post('/transaction', 'Hotel::transaction');
$routes->get('/transaction', 'Hotel::transaction');
$routes->get('/rooms/(:any)', 'Hotel::detail/$1');
$routes->get('/order/(:any)', 'Hotel::order/$1');
$routes->post('/payment/(:any)', 'Hotel::payment/$1');
$routes->get('/download/(:num)', 'Hotel::download/$1');

$routes->get('/profile', 'Profil::index');
$routes->get('/profile/settings', 'Profil::edit');
$routes->get('/profile/transaksi', 'Profil::transaksi');
$routes->post('/profile/transaksi', 'Profil::transaksi');
$routes->get('/profile/order/(:num)', 'Profil::order/$1');

$routes->group('/admin', ['filter' => 'role:admin'], function ($routes)
{
	$routes->get('/', 'Dashboard::index');

	$routes->get('kamar', 'Kamar::index');
	$routes->post('kamar/save', 'Kamar::save');
	$routes->post('kamar/update/(:num)', 'Kamar::update/$1');
	$routes->get('kamar/create', 'Kamar::create');
	$routes->get('kamar/edit/(:any)', 'Kamar::edit/$1');
	$routes->delete('kamar/(:num)', 'Kamar::delete/$1');
	$routes->get('kamar/(:any)', 'Kamar::detail/$1');

	$routes->get('ruangan', 'Ruangan::index');
	$routes->post('ruangan', 'Ruangan::index');
	$routes->post('ruangan/save', 'Ruangan::save');
	$routes->post('ruangan/update/(:num)', 'Ruangan::update/$1');
	$routes->post('ruangan/status/(:num)', 'Ruangan::status/$1');
	$routes->get('ruangan/create', 'Ruangan::create');
	$routes->get('ruangan/edit/(:any)', 'Ruangan::edit/$1');
	$routes->delete('ruangan/(:num)', 'Ruangan::delete/$1');

	$routes->get('transaksi', 'Transaksi::index');
	$routes->post('transaksi', 'Transaksi::index');

	$routes->get('user', 'User::index');
	$routes->get('user/(:num)', 'User::detail/$1');
	$routes->post('user/role/(:num)', 'User::role/$1');
	$routes->delete('user/(:num)', 'User::delete/$1');
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
