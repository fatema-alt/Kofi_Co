<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 
 */
$routes->get('/', 'Auth::login'); $routes->get('login', 'Auth::login'); 
$routes->post('login', 'Auth::attemptLogin'); 
$routes->get('logout', 'Auth::logout');

$routes->group('admin', ['filter' => 'auth'], function($routes) {

    // Dashboard + Profile
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('profile', 'Admin\Profile::index');
    $routes->post('profile/update', 'Admin\Profile::update');

    // POS
    $routes->get('pos', 'Admin\Pos::index', ['filter' => 'role:Cashier,Admin,Manager']);
    $routes->post('pos/checkout', 'Admin\Pos::checkout', ['filter' => 'role:Cashier,Admin,Manager']);

    // Orders
    $routes->get('orders', 'Admin\Orders::index', ['filter' => 'role:Cashier,Admin,Manager']);
    $routes->get('orders/show/(:num)', 'Admin\Orders::show/$1', ['filter' => 'role:Cashier,Admin,Manager']);
    $routes->get('orders/receipt/(:num)', 'Admin\Orders::receipt/$1', ['filter' => 'role:Cashier,Admin,Manager']);
    $routes->get('orders/delete/(:num)', 'Admin\Orders::delete/$1', ['filter' => 'role:Admin']);

    // Menu Categories
    $routes->get('menu/categories', 'Menu\Categories::index', ['filter' => 'role:Manager,Admin']);
    $routes->get('menu/categories/create', 'Menu\Categories::create', ['filter' => 'role:Manager,Admin']);
    $routes->post('menu/categories/store', 'Menu\Categories::store', ['filter' => 'role:Manager,Admin']);
    $routes->get('menu/categories/edit/(:num)', 'Menu\Categories::edit/$1', ['filter' => 'role:Manager,Admin']);
    $routes->post('menu/categories/update/(:num)', 'Menu\Categories::update/$1', ['filter' => 'role:Manager,Admin']);
    $routes->get('menu/categories/delete/(:num)', 'Menu\Categories::delete/$1', ['filter' => 'role:Manager,Admin']);

    // Menu Items
    $routes->get('menu/items', 'Menu\Items::index', ['filter' => 'role:Manager,Admin']);
    $routes->get('menu/items/create', 'Menu\Items::create', ['filter' => 'role:Manager,Admin']);
    $routes->post('menu/items/store', 'Menu\Items::store', ['filter' => 'role:Manager,Admin']);
    $routes->get('menu/items/edit/(:num)', 'Menu\Items::edit/$1', ['filter' => 'role:Manager,Admin']);
    $routes->post('menu/items/update/(:num)', 'Menu\Items::update/$1', ['filter' => 'role:Manager,Admin']);
    $routes->get('menu/items/delete/(:num)', 'Menu\Items::delete/$1', ['filter' => 'role:Manager,Admin']);

    // Recipe Mapping
    $routes->post('menu/items/recipe/store', 'Menu\Items::storeRecipe', ['filter' => 'role:Manager,Admin']);
    $routes->get('menu/items/recipe/delete/(:num)/(:num)', 'Menu\Items::deleteRecipe/$1/$2', ['filter' => 'role:Manager,Admin']);

    // Ingredients
    $routes->get('ingredients', 'Admin\Ingredients::index', ['filter' => 'role:Manager,Admin']);
    $routes->get('ingredients/create', 'Admin\Ingredients::create', ['filter' => 'role:Manager,Admin']);
    $routes->post('ingredients/store', 'Admin\Ingredients::store', ['filter' => 'role:Manager,Admin']);
    $routes->get('ingredients/edit/(:num)', 'Admin\Ingredients::edit/$1', ['filter' => 'role:Manager,Admin']);
    $routes->post('ingredients/update/(:num)', 'Admin\Ingredients::update/$1', ['filter' => 'role:Manager,Admin']);
    $routes->get('ingredients/delete/(:num)', 'Admin\Ingredients::delete/$1', ['filter' => 'role:Manager,Admin']);

    // Stock Movements
    $routes->get('stock-movements', 'Admin\StockMovements::index', ['filter' => 'role:Manager,Admin']);
    $routes->get('stock-movements/create', 'Admin\StockMovements::create', ['filter' => 'role:Manager,Admin']);
    $routes->post('stock-movements/store', 'Admin\StockMovements::store', ['filter' => 'role:Manager,Admin']);

    // Vendors
    $routes->get('vendors', 'Admin\Vendors::index', ['filter' => 'role:Manager,Admin']);
    $routes->get('vendors/create', 'Admin\Vendors::create', ['filter' => 'role:Manager,Admin']);
    $routes->post('vendors/store', 'Admin\Vendors::store', ['filter' => 'role:Manager,Admin']);
    $routes->get('vendors/edit/(:num)', 'Admin\Vendors::edit/$1', ['filter' => 'role:Manager,Admin']);
    $routes->post('vendors/update/(:num)', 'Admin\Vendors::update/$1', ['filter' => 'role:Manager,Admin']);
    $routes->get('vendors/delete/(:num)', 'Admin\Vendors::delete/$1', ['filter' => 'role:Manager,Admin']);

    // Reports
    $routes->get('reports', 'Admin\Reports::index', ['filter' => 'role:Manager,Admin']);

    // Settings
    $routes->get('settings', 'Admin\Settings::index', ['filter' => 'role:Admin']);
    $routes->post('settings/update', 'Admin\Settings::update', ['filter' => 'role:Admin']);

    // Users & Roles - Admin only
    $routes->get('users', 'Admin\Users::index', ['filter' => 'role:Admin']);
    $routes->get('users/create', 'Admin\Users::create', ['filter' => 'role:Admin']);
    $routes->post('users/store', 'Admin\Users::store', ['filter' => 'role:Admin']);
    $routes->get('users/edit/(:num)', 'Admin\Users::edit/$1', ['filter' => 'role:Admin']);
    $routes->post('users/update/(:num)', 'Admin\Users::update/$1', ['filter' => 'role:Admin']);
    $routes->get('users/delete/(:num)', 'Admin\Users::delete/$1', ['filter' => 'role:Admin']);
});