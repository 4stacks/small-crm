<?php

namespace App\Core;

use PDO;
use PDOException;

/**
 * Database Class
 * Handles database connections and provides a PDO instance
 */
class Database
{
    /**
     * PDO instance
     * @var PDO
     */
    private static $instance = null;

    /**
     * Database configuration
     * @var array
     */
    private $config;

    /**
     * PDO connection
     * @var PDO
     */
    private $connection;

    /**
     * Constructor - reads database configuration
     */
    private function __construct()
    {
        $this->config = [
            'host' => getenv('DB_HOST') ?: 'db',
            'name' => getenv('DB_NAME') ?: 'small_crm',
            'user' => getenv('DB_USER') ?: 'crm_user',
            'pass' => getenv('DB_PASS') ?: 'crm_password'
        ];

        $this->connect();
    }

    /**
     * Get database instance (Singleton)
     * @return PDO
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->connection;
    }

    /**
     * Get PDO connection
     * @return PDO
     */
    private function getConnection()
    {
        return $this->connection;
    }

    /**
     * Connect to database
     * @throws PDOException
     */
    private function connect()
    {
        try {
            $dsn = "mysql:host={$this->config['host']};dbname={$this->config['name']};charset=utf8mb4";
            
            $this->connection = new PDO(
                $dsn,
                $this->config['user'],
                $this->config['pass'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            throw new PDOException("Connection failed: " . $e->getMessage());
        }
    }

    /**
     * Prevent cloning of the instance
     */
    private function __clone()
    {
    }

    /**
     * Prevent unserializing of the instance
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }
}