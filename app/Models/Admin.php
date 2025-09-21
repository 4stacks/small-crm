<?php
namespace App\Models;

use App\Core\Model;

class Admin extends Model {
    protected $table = 'admin';

    public function authenticate($username, $password) {
        $username = $this->db->escapeString($username);
        $password = $this->db->escapeString($password);
        
        $result = $this->db->query(
            "SELECT * FROM {$this->table} 
            WHERE name = '{$username}' 
            AND password = '{$password}' 
            LIMIT 1"
        );
        
        return mysqli_fetch_assoc($result);
    }

    public function updatePassword($adminId, $newPassword) {
        $adminId = $this->db->escapeString($adminId);
        $newPassword = $this->db->escapeString($newPassword);
        
        return $this->db->query(
            "UPDATE {$this->table} 
            SET password = '{$newPassword}' 
            WHERE id = '{$adminId}'"
        );
    }

    public function getUserAccessLogs() {
        $result = $this->db->query(
            "SELECT * FROM usercheck 
            ORDER BY logindate DESC, logintime DESC"
        );
        
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}