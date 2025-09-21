<?php
namespace App\Models;

use App\Core\Model;

class Ticket extends Model {
    protected $table = 'ticket';

    public function createTicket($data) {
        $data['ticket_id'] = $this->generateTicketId();
        $data['status'] = 'Open';
        $data['posting_date'] = date('Y-m-d');
        
        return $this->create($data);
    }

    public function getTicketsByEmail($email) {
        $email = $this->db->escapeString($email);
        $result = $this->db->query(
            "SELECT * FROM {$this->table} 
            WHERE email_id = '{$email}' 
            ORDER BY posting_date DESC"
        );
        
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function updateStatus($ticketId, $status) {
        $ticketId = $this->db->escapeString($ticketId);
        $status = $this->db->escapeString($status);
        
        return $this->db->query(
            "UPDATE {$this->table} 
            SET status = '{$status}' 
            WHERE ticket_id = '{$ticketId}'"
        );
    }

    private function generateTicketId() {
        // Read current counter from file
        $counterFile = ROOT_PATH . '/hitcounter.txt';
        $hits = file($counterFile);
        $counter = (int)$hits[0];
        $counter++;
        
        // Update counter file
        file_put_contents($counterFile, $counter);
        
        return $counter;
    }
}