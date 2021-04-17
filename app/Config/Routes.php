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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->add('/signin', 'Users::index');
$routes->add('/logoff', 'Users::logoff');
$routes->add('/register', 'Users::register');
$routes->add('/users/login', 'Users::login');
$routes->add('/users/register', 'Users::register_user');
$routes->add('/dashboard/admin', 'Home::show_dashboard');
$routes->add('/dashboard', 'Home::show_dashboard');
$routes->add('/users/new', 'Users::new');
$routes->add('/users/edit/', 'Users::edit_profile');
$routes->add('/users/edit/(:num)', 'Users::edit/$1');
$routes->add('/users/update/(:num)', 'Users::update/$1');
$routes->add('/users/update_password/(:num)', 'Users::update_password/$1');
$routes->add('/users/update_description/', 'Users::update_description');
$routes->add('/users/delete/(:num)', 'Users::remove_user/$1');
$routes->add('/users/destroy/(:num)', 'Users::destroy_user/$1');
$routes->add('/users/show/(:num)', 'Users::show_user/$1');

$routes->add('/messages/create/(:num)', 'Messages::create/$1');

$routes->add('/comments/create/(:num)', 'Comments::create/$1');
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
