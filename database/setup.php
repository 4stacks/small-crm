<?php

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load bootstrap file
require_once __DIR__ . '/bootstrap.php';

// Check for --fresh flag
$fresh = in_array('--fresh', $argv);

// Run migrations
echo "Running migrations...\n";
require_once __DIR__ . '/migrations/migrate.php';

// Run seeds if successful and --seed flag is present
if (in_array('--seed', $argv)) {
    echo "\nRunning seeds...\n";
    require_once __DIR__ . '/seeds/seed.php';
}

echo "\nDatabase setup completed!\n";