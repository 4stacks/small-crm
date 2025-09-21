<?php
/**
 * Route Definitions
 */

// Auth routes
$router->add('', ['controller' => 'auth', 'action' => 'login']);
$router->add('login', ['controller' => 'auth', 'action' => 'login']);
$router->add('register', ['controller' => 'auth', 'action' => 'register']);
$router->add('forgot-password', ['controller' => 'auth', 'action' => 'forgotPassword']);
$router->add('logout', ['controller' => 'auth', 'action' => 'logout']);

// User routes
$router->add('dashboard', ['controller' => 'user', 'action' => 'dashboard']);
$router->add('profile', ['controller' => 'user', 'action' => 'profile']);
$router->add('profile/update', ['controller' => 'user', 'action' => 'updateProfile']);
$router->add('change-password', ['controller' => 'user', 'action' => 'changePassword']);

// Ticket routes
$router->add('tickets', ['controller' => 'ticket', 'action' => 'index']);
$router->add('tickets/create', ['controller' => 'ticket', 'action' => 'create']);
$router->add('tickets/view/{id:\d+}', ['controller' => 'ticket', 'action' => 'view']);
$router->add('tickets/close/{id:\d+}', ['controller' => 'ticket', 'action' => 'close']);

// Quote routes
$router->add('quotes', ['controller' => 'quote', 'action' => 'index']);
$router->add('quotes/create', ['controller' => 'quote', 'action' => 'create']);
$router->add('quotes/view/{id:\d+}', ['controller' => 'quote', 'action' => 'view']);

// Admin routes
$router->add('admin', ['controller' => 'admin', 'action' => 'index']);
$router->add('admin/login', ['controller' => 'auth', 'action' => 'adminLogin']);
$router->add('admin/dashboard', ['controller' => 'admin', 'action' => 'dashboard']);
$router->add('admin/users', ['controller' => 'admin', 'action' => 'users']);
$router->add('admin/users/{id:\d+}', ['controller' => 'admin', 'action' => 'editUser']);
$router->add('admin/tickets', ['controller' => 'admin', 'action' => 'tickets']);
$router->add('admin/quotes', ['controller' => 'admin', 'action' => 'quotes']);
$router->add('admin/access-logs', ['controller' => 'admin', 'action' => 'accessLogs']);