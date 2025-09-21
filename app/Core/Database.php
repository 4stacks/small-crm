<?php
namespace App\Core;

class Database {
    private static $instance = null;
    private $connection;
    private $config;

    private function __construct() {
        $this->config = require __DIR__ . '/../../config/config.php';
        $this->connect();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function connect() {
        $this->connection = mysqli_connect(
            $this->config['db']['host'],
            $this->config['db']['user'],
            $this->config['db']['pass'],
            $this->config['db']['name']
        );

        if (mysqli_connect_errno()) {
            throw new \Exception("Database connection failed: " . mysqli_connect_error());
        }
    }

    public function query($sql) {
        $result = mysqli_query($this->connection, $sql);
        if (!$result) {
            throw new \Exception("Query failed: " . mysqli_error($this->connection));
        }
        return $result;
    }

    public function escapeString($string) {
        return mysqli_real_escape_string($this->connection, $string);
    }

    public function getLastInsertId() {
        return mysqli_insert_id($this->connection);
    }

    public function __destruct() {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }
}