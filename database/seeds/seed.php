<?php

require_once __DIR__ . '/../app/Core/Database.php';

class Seeder {
    private $db;
    private $pdo;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->pdo = $this->db->getConnection();
    }

    public function run() {
        try {
            $this->pdo->beginTransaction();

            // Seed admin user
            $adminPassword = password_hash('admin123', PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->execute(['Administrator', 'admin@example.com', $adminPassword, 'admin']);
            $adminId = $this->pdo->lastInsertId();
            echo "Admin user created\n";

            // Seed test users
            $users = [
                ['John Doe', 'john@example.com'],
                ['Jane Smith', 'jane@example.com'],
                ['Bob Wilson', 'bob@example.com']
            ];

            $userPassword = password_hash('password123', PASSWORD_DEFAULT);
            foreach ($users as $user) {
                $stmt->execute([$user[0], $user[1], $userPassword, 'user']);
                echo "Created user: {$user[0]}\n";
            }

            // Seed sample tickets
            $ticketStmt = $this->pdo->prepare("
                INSERT INTO tickets (user_id, subject, description, status, priority) 
                VALUES (?, ?, ?, ?, ?)
            ");

            $tickets = [
                [
                    'subject' => 'Login Issue',
                    'description' => 'Unable to login to the dashboard',
                    'status' => 'open',
                    'priority' => 'high'
                ],
                [
                    'subject' => 'Feature Request',
                    'description' => 'Add export to PDF functionality',
                    'status' => 'in_progress',
                    'priority' => 'medium'
                ],
                [
                    'subject' => 'Bug Report',
                    'description' => 'Charts not displaying correctly',
                    'status' => 'closed',
                    'priority' => 'low'
                ]
            ];

            foreach ($tickets as $ticket) {
                $userId = rand(2, 4); // Random user (excluding admin)
                $ticketStmt->execute([
                    $userId,
                    $ticket['subject'],
                    $ticket['description'],
                    $ticket['status'],
                    $ticket['priority']
                ]);
                $ticketId = $this->pdo->lastInsertId();
                echo "Created ticket: {$ticket['subject']}\n";

                // Add sample comment to each ticket
                $commentStmt = $this->pdo->prepare("
                    INSERT INTO comments (ticket_id, user_id, content)
                    VALUES (?, ?, ?)
                ");
                $commentStmt->execute([
                    $ticketId,
                    $adminId,
                    "Thank you for reporting this issue. We'll look into it."
                ]);
            }

            // Add sample activity logs
            $logStmt = $this->pdo->prepare("
                INSERT INTO activity_logs (user_id, action, description, ip_address)
                VALUES (?, ?, ?, ?)
            ");

            $logStmt->execute([
                $adminId,
                'login',
                'Admin logged into the system',
                '127.0.0.1'
            ]);

            $this->pdo->commit();
            echo "Database seeded successfully!\n";
            return true;

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo "Error seeding database: " . $e->getMessage() . "\n";
            return false;
        }
    }
}

// Run seeder
echo "Seeding database...\n";
$seeder = new Seeder();
$seeder->run();