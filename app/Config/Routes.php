<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/api/create', 'HomeApi::create_api');
$routes->put('/api/update', 'HomeApi::update_api');
$routes->delete('/api/delete', 'HomeApi::delete_api');
