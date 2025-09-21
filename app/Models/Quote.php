<?php
namespace App\Models;

use App\Core\Model;

class Quote extends Model {
    protected $table = 'prequest';

    public function createQuote($data) {
        $data['posting_date'] = date('Y-m-d');
        return $this->create($data);
    }

    public function getQuotes() {
        $result = $this->db->query(
            "SELECT * FROM {$this->table} 
            ORDER BY posting_date DESC"
        );
        
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getQuoteDetails($id) {
        $id = $this->db->escapeString($id);
        $result = $this->db->query(
            "SELECT * FROM {$this->table} 
            WHERE id = '{$id}' 
            LIMIT 1"
        );
        
        return mysqli_fetch_assoc($result);
    }
}