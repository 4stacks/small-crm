<?php

// Define constants
define('APP_ROOT', dirname(__DIR__) . '/app');
define('BASE_PATH', dirname(__DIR__));

// Autoload classes
spl_autoload_register(function ($class) {
    // Convert namespace to file path
    $file = BASE_PATH . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Load environment variables
(new App\Core\Config())->loadEnv();

// Start session
session_start();

// Set error handling in development
if (getenv('APP_DEBUG') === 'true') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Initialize database connection
try {
    App\Core\Database::getInstance();
} catch (Exception $e) {
    // Log error and display friendly message
    error_log($e->getMessage());
    die('Could not connect to the database. Please try again later.');
}

// Create Router instance
$router = new App\Core\Router();