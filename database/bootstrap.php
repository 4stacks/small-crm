<?php

define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('DATABASE_PATH', ROOT_PATH . '/database');

// Register class autoloader
spl_autoload_register(function ($class) {
    // Convert namespace to path
    $parts = explode('\\', $class);
    
    // Handle App namespace
    if ($parts[0] === 'App') {
        array_shift($parts); // Remove 'App'
        $filepath = APP_PATH . '/' . implode('/', $parts) . '.php';
    } else {
        $filepath = ROOT_PATH . '/' . implode('/', $parts) . '.php';
    }
    
    if (file_exists($filepath)) {
        require_once $filepath;
    }
});

// Load environment variables if .env exists
$envFile = ROOT_PATH . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            // Remove quotes if present
            if (preg_match('/^(["\']).*\1$/', $value)) {
                $value = substr($value, 1, -1);
            }
            
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

// Required classes
use App\Core\Database;
use App\Core\Config;

// Initialize database connection
try {
    // Initialize Database
    $db = Database::getInstance();
    echo "Database connection established successfully.\n";
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage() . "\n");
}