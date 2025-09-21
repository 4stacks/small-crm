<?php
namespace App\Models;

use App\Core\Model;

class User extends Model {
    protected $table = 'user';

    public function authenticate($email, $password) {
        $email = $this->db->escapeString($email);
        $password = $this->db->escapeString($password);
        
        $result = $this->db->query(
            "SELECT * FROM {$this->table} 
            WHERE email = '{$email}' 
            AND password = '{$password}' 
            LIMIT 1"
        );
        
        return mysqli_fetch_assoc($result);
    }

    public function findByEmail($email) {
        $email = $this->db->escapeString($email);
        $result = $this->db->query(
            "SELECT * FROM {$this->table} 
            WHERE email = '{$email}' 
            LIMIT 1"
        );
        
        return mysqli_fetch_assoc($result);
    }

    public function updatePassword($userId, $newPassword) {
        $userId = $this->db->escapeString($userId);
        $newPassword = $this->db->escapeString($newPassword);
        
        return $this->db->query(
            "UPDATE {$this->table} 
            SET password = '{$newPassword}' 
            WHERE id = '{$userId}'"
        );
    }

    public function logAccess($userId, $data) {
        $userId = $this->db->escapeString($userId);
        $data['user_id'] = $userId;
        
        return $this->db->query(
            "INSERT INTO usercheck 
            (user_id, logindate, logintime, username, email, ip, mac, city, country) 
            VALUES (
                '{$data['user_id']}',
                '{$data['logindate']}',
                '{$data['logintime']}',
                '{$data['username']}',
                '{$data['email']}',
                '{$data['ip']}',
                '{$data['mac']}',
                '{$data['city']}',
                '{$data['country']}'
            )"
        );
    }
}