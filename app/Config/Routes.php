<?php

namespace Config;

// Create a new instance of our RouteCollection class.
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

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Home::index');

$routes->get('brand', 'BrandController::index');
// $routes->get('brand', 'BrandController::fetch_brand');
$routes->post('brand/add_brand', 'BrandController::add_brand');
// $routes->get('brand/fetch_brand', 'BrandController::fetch_brand');
$routes->post('brand/edit_brand', 'BrandController::edit_brand');
$routes->post('brand/update_brand', 'BrandController::update_brand');
$routes->post('brand/delete_brand', 'BrandController::delete_brand');

$routes->get('model', 'ModelController::index');
$routes->post('model/add_model', 'ModelController::add_model');
$routes->post('model/edit_model', 'ModelController::edit_model');
$routes->post('model/update_model', 'ModelController::update_model');
$routes->post('model/delete_model', 'ModelController::delete_model');

$routes->get('item', 'ItemController::index');
$routes->post('item/add_item', 'ItemController::add_item');
$routes->post('item/edit_item', 'ItemController::edit_item');
$routes->post('item/update_item', 'ItemController::update_item');
$routes->post('item/delete_item', 'ItemController::delete_item');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
