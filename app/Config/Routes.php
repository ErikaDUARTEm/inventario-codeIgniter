<?php

namespace Config;

use App\Models\Product;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('/products', 'ProductsController::index');
$routes->get('/products/new', 'ProductsController::create');
$routes->post('/products', 'ProductsController::save');

$routes->get('/providers', 'ProvidersController::index');
$routes->get('/providers/new', 'ProvidersController::create');
$routes->post('/providers', 'ProvidersController::save');

$routes->get('/employees', 'EmployeesController::index');
$routes->get('/employees/new', 'EmployeesController::create');
$routes->post('/employees', 'EmployeesController::save');

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
