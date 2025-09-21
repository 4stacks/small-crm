<?php
/**
 * Front Controller
 */

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define root path
define('ROOT_PATH', dirname(__DIR__));

// Require the autoloader
require_once ROOT_PATH . '/app/Core/Autoloader.php';

// Start session
session_start();

// Load configuration
$config = require_once ROOT_PATH . '/config/config.php';

// Initialize Router
$router = new \App\Core\Router();

// Load routes from config
$routes = require_once ROOT_PATH . '/config/routes.php';

// Define routes
foreach ($routes as $url => $params) {
    $router->add($url, $params);
}

// Dispatch the route
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
try {
    $router->dispatch($uri);
} catch (\Exception $e) {
    // Handle 404 or other errors
    http_response_code($e->getCode() === 404 ? 404 : 500);
    echo $e->getMessage();
}
$router->add('tickets/create', ['controller' => 'ticket', 'action' => 'create']);
$router->add('quotes', ['controller' => 'quote', 'action' => 'index']);
$router->add('quotes/create', ['controller' => 'quote', 'action' => 'create']);
$router->add('profile', ['controller' => 'user', 'action' => 'profile']);
$router->add('admin', ['controller' => 'admin', 'action' => 'index']);

try {
    // Get the current URL path
    $url = trim($_SERVER['REQUEST_URI'], '/');
    
    // Dispatch the route
    $router->dispatch($url);
    
} catch (Exception $e) {
    // Handle 404 and other errors
    echo $e->getMessage();
}