<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->get('udboard', 'FrontendController::index');


$routes->get('imprimirComprobante', 'TicketController::imprimirComprobante');

$routes->get('exportarpdf', 'TicketController::exportarPDF');
$routes->get('exportarxlsx', 'TicketController::exportarXLSX');

// Ruta para testear creación de pdf
$routes->get('tickets/pdf', 'TicketController::generarPDF');

$routes->get('tickets', 'TicketController::index');
$routes->get('tickets/new', 'TicketController::new');
$routes->post('tickets', 'TicketController::create');
$routes->get('tickets/(:num)', 'TicketController::show/$1');
$routes->get('tickets/edit/(:num)', 'TicketController::edit/$1');
$routes->put('tickets/(:num)', 'TicketController::update/$1');
$routes->delete('tickets/(:num)', 'TicketController::delete/$1');

$routes->resource('kanban', ['controller' => 'kanbanController']);


$routes->get('solicitud', 'Solicitante::index');
$routes->get('solicitud/new', 'Solicitante::new');
$routes->post('solicitud', 'Solicitante::create');
$routes->get('solicitud/ticketEnviado', 'Solicitante::ticketEnviado');
// $routes->resource('solicitud', ['controller' => 'Solicitante']);

$routes->get('/', 'Home::index');

service('auth')->routes($routes);

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
