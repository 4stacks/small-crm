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

// Define routes
$router->add('', ['controller' => 'home', 'action' => 'index']);
$router->add('login', ['controller' => 'auth', 'action' => 'login']);
$router->add('register', ['controller' => 'auth', 'action' => 'register']);
$router->add('dashboard', ['controller' => 'dashboard', 'action' => 'index']);
$router->add('tickets', ['controller' => 'ticket', 'action' => 'index']);
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