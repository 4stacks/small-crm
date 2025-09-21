<?php

namespace App\Core;

class Config {
    private static $config = [];
    private static $instance = null;

    private function __construct() {
        // Load environment variables from .env file
        $this->loadEnv();
        
        // Set default configurations
        self::$config = [
            'db' => [
                'host' => getenv('DB_HOST') ?: 'localhost',
                'name' => getenv('DB_NAME') ?: 'small_crm',
                'user' => getenv('DB_USER') ?: 'root',
                'pass' => getenv('DB_PASS') ?: '',
                'port' => getenv('DB_PORT') ?: '3306'
            ],
            'app' => [
                'name' => 'Small CRM',
                'url' => getenv('APP_URL') ?: 'http://localhost',
                'debug' => getenv('APP_DEBUG') === 'true',
                'environment' => getenv('APP_ENV') ?: 'development'
            ]
        ];
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function loadEnv() {
        $envFile = dirname(dirname(__DIR__)) . '/.env';
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
    }

    public static function get($key, $default = null) {
        self::getInstance();
        
        $keys = explode('.', $key);
        $config = self::$config;

        foreach ($keys as $key) {
            if (!isset($config[$key])) {
                return $default;
            }
            $config = $config[$key];
        }

        return $config;
    }

    public static function set($key, $value) {
        self::getInstance();
        
        $keys = explode('.', $key);
        $config = &self::$config;

        while (count($keys) > 1) {
            $key = array_shift($keys);
            if (!isset($config[$key]) || !is_array($config[$key])) {
                $config[$key] = [];
            }
            $config = &$config[$key];
        }

        $config[array_shift($keys)] = $value;
    }
}