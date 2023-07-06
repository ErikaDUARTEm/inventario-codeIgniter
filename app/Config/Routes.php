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
// $routes->get('/', 'Home::index');
$routes->get('/', 'AuthController::index');
$routes->post('/auth', 'AuthController::auth');
$routes->post("salir", "AuthController::logout");

$routes->get('/tablero', 'TableroController::index');
$routes->post('/tablero', 'TableroController::tablero');


$routes->get('/products', 'ProductsController::index'); // lista productos
$routes->get('/products/new', 'ProductsController::create'); // vista nuevo
$routes->post('/products', 'ProductsController::save'); // guardar productos
$routes->get('/products/edit/(:num)', 'ProductsController::edit/$1');
$routes->put("/products", "ProductsController::update");
$routes->delete("/products/(:num)", "ProductsController::delete/$1");

$routes->get('/providers', 'ProvidersController::index');
$routes->get('/providers/new', 'ProvidersController::create');
$routes->post('/providers', 'ProvidersController::save');
$routes->get('/providers/edit/(:num)', 'ProvidersController::edit/$1');
$routes->put("/providers", "ProvidersController::update");
$routes->delete("/providers/(:num)", "ProvidersController::delete/$1");

$routes->get('/employees', 'EmployeesController::index');
$routes->get('/employees/new', 'EmployeesController::create');
$routes->post('/employees', 'EmployeesController::save');
$routes->get('/employees/edit/(:num)', 'EmployeesController::edit/$1');
$routes->put("/employees", "EmployeesController::update");
$routes->delete("/employees/(:num)", "EmployeesController::delete/$1");


$routes->get('/customers', 'CustomersController::index');
$routes->get('/customers/new', 'CustomersController::create');
$routes->post('/customers', 'CustomersController::save');
$routes->get('/customers/edit/(:num)', 'CustomersController::edit/$1');
$routes->put("/customers", "CustomersController::update");
$routes->delete("/customers/(:num)", "CustomersController::delete/$1");




if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
