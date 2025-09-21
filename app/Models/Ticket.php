<?php
namespace App\Models;

use App\Core\Model;

class Ticket extends Model {
    protected $table = 'tickets';
    
    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'status',
        'priority',
        'ticket_id'
    ];

    public function createTicket($data) {
        $data['ticket_id'] = $this->generateTicketId();
        $data['status'] = 'open';
        
        return $this->create($data);
    }

    public function getTicketComments($ticketId) {
        return $this->db->query(
            "SELECT c.*, u.name as user_name 
            FROM comments c 
            JOIN users u ON c.user_id = u.id 
            WHERE c.ticket_id = ? 
            ORDER BY c.created_at ASC",
            [$ticketId]
        )->fetchAll();
    }

    public function addComment($ticketId, $userId, $content) {
        return $this->db->insert('comments', [
            'ticket_id' => $ticketId,
            'user_id' => $userId,
            'content' => $content
        ]);
    }

    private function generateTicketId() {
        // Generate ticket ID based on current timestamp and random number
        $timestamp = date('Ymd');
        $random = mt_rand(1000, 9999);
        return "TKT-{$timestamp}-{$random}";
    }

    public function getAllTickets($status = null) {
        $sql = "SELECT t.*, u.name as user_name 
                FROM {$this->table} t 
                JOIN users u ON t.user_id = u.id";
                
        $params = [];
        
        if ($status) {
            $sql .= " WHERE t.status = ?";
            $params[] = $status;
        }
        
        $sql .= " ORDER BY t.created_at DESC";
        
        return $this->db->query($sql, $params)->fetchAll();
    }

    public function getTicketDetails($id) {
        $result = $this->db->query(
            "SELECT t.*, u.name as user_name 
            FROM {$this->table} t 
            JOIN users u ON t.user_id = u.id 
            WHERE t.id = ?",
            [$id]
        )->fetch();

        if ($result) {
            $result['comments'] = $this->getTicketComments($id);
        }

        return $result;
    }

    public function getStats() {
        return [
            'total' => $this->count(),
            'open' => $this->count(['status' => 'open']),
            'in_progress' => $this->count(['status' => 'in_progress']),
            'closed' => $this->count(['status' => 'closed'])
        ];
    }
}