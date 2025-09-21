<?php
namespace App\Core;

use App\Models\User;

class Auth {
    public function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }

    public function isAdmin() {
        if (!$this->isAuthenticated()) {
            return false;
        }

        $user = (new User())->find($_SESSION['user_id']);
        return $user && $user['role'] === 'admin';
    }

    public function login($email, $password) {
        $user = (new User())->findByEmail($email);
        
        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }

        $_SESSION['user_id'] = $user['id'];
        return true;
    }

    public function logout() {
        unset($_SESSION['user_id']);
        session_destroy();
    }

    public function getCurrentUser() {
        if (!$this->isAuthenticated()) {
            return null;
        }

        return (new User())->find($_SESSION['user_id']);
    }
}