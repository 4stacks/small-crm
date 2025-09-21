<?php

// Define constants needed for views
define('APP_ROOT', dirname(dirname(__DIR__)) . '/app');

// Mock data for testing
$data = [
    'error' => 'Test error message',
    'success' => 'Test success message',
    'token' => 'test-reset-token-123',
    'user' => [
        'name' => 'Test User',
        'email' => 'test@example.com'
    ]
];

// Function to test view rendering
function testView($viewPath, $data) {
    echo "\nTesting view: $viewPath\n";
    echo "----------------------------------------\n";
    
    if (!file_exists($viewPath)) {
        echo "ERROR: View file not found: $viewPath\n";
        return false;
    }
    
    // Start output buffering to capture the view output
    ob_start();
    try {
        require $viewPath;
        $output = ob_get_clean();
        echo "SUCCESS: View rendered successfully\n";
        
        // Basic content checks
        $checks = [
            'DOCTYPE html' => 'HTML5 declaration',
            'bootstrap' => 'Bootstrap CSS/JS',
            'form' => 'Form element',
            'container' => 'Bootstrap container'
        ];
        
        foreach ($checks as $string => $description) {
            if (strpos($output, $string) !== false) {
                echo "✓ Found $description\n";
            } else {
                echo "✗ Missing $description\n";
            }
        }
        
        return true;
    } catch (Exception $e) {
        ob_end_clean();
        echo "ERROR: " . $e->getMessage() . "\n";
        return false;
    }
}

// Test all auth views
$views = [
    'login' => APP_ROOT . '/Views/auth/login.php',
    'forgot-password' => APP_ROOT . '/Views/auth/forgot-password.php',
    'reset-password' => APP_ROOT . '/Views/auth/reset-password.php'
];

$totalTests = count($views);
$passedTests = 0;

foreach ($views as $name => $path) {
    if (testView($path, $data)) {
        $passedTests++;
    }
}

echo "\nTest Summary\n";
echo "----------------------------------------\n";
echo "Total tests: $totalTests\n";
echo "Passed: $passedTests\n";
echo "Failed: " . ($totalTests - $passedTests) . "\n";