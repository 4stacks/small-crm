<?php

require_once __DIR__ . '/../app/Core/Database.php';

class Migration {
    private $db;
    private $pdo;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->pdo = $this->db->getConnection();
    }

    public function createTables() {
        try {
            // Start transaction
            $this->pdo->beginTransaction();

            // Users table
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
                remember_token VARCHAR(100),
                reset_token VARCHAR(100),
                reset_token_expires_at DATETIME,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Tickets table
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS tickets (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                subject VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                status ENUM('open', 'in_progress', 'closed') NOT NULL DEFAULT 'open',
                priority ENUM('low', 'medium', 'high') NOT NULL DEFAULT 'medium',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Comments table
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS comments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                ticket_id INT NOT NULL,
                user_id INT NOT NULL,
                content TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Login attempts table for security
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS login_attempts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(100) NOT NULL,
                ip_address VARCHAR(45) NOT NULL,
                attempted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Activity logs table
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS activity_logs (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT,
                action VARCHAR(100) NOT NULL,
                description TEXT,
                ip_address VARCHAR(45),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Commit transaction
            $this->pdo->commit();
            echo "Database tables created successfully!\n";
            return true;

        } catch (PDOException $e) {
            // Rollback transaction on error
            $this->pdo->rollBack();
            echo "Error creating tables: " . $e->getMessage() . "\n";
            return false;
        }
    }

    public function dropTables() {
        try {
            $this->pdo->beginTransaction();

            // Drop tables in reverse order of dependencies
            $tables = [
                'activity_logs',
                'login_attempts',
                'comments',
                'tickets',
                'users'
            ];

            foreach ($tables as $table) {
                $this->pdo->exec("DROP TABLE IF EXISTS $table");
                echo "Dropped table: $table\n";
            }

            $this->pdo->commit();
            echo "All tables dropped successfully!\n";
            return true;

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo "Error dropping tables: " . $e->getMessage() . "\n";
            return false;
        }
    }
}

// Run migrations
$migration = new Migration();

// Check for command line argument
if ($argc > 1 && $argv[1] === '--fresh') {
    echo "Dropping existing tables...\n";
    $migration->dropTables();
}

echo "Running migrations...\n";
$migration->createTables();