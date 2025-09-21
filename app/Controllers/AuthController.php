<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\Controller;

class AuthController extends Controller
{
    private $user;
    
    private function renderView($view, $data = []) {
        $content = $this->view($view, $data);
        echo $content;
    }

    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $user = $this->user->authenticate($email, $password);
            
            if ($user) {
                $_SESSION['user'] = $user;
                $_SESSION['user_id'] = $user['id'];
                
                header('Location: /dashboard');
                exit;
            } else {
                $error = 'Invalid email or password';
                $this->renderView('auth/login', ['error' => $error]);
            }
        } else {
            $this->renderView('auth/login');
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'type' => 'user'
            ];
            
            // Validate input
            $errors = $this->validateRegistration($data);
            
            if (empty($errors)) {
                if ($this->user->create($data)) {
                    header('Location: /login');
                    exit;
                } else {
                    $errors[] = 'Registration failed';
                }
            }
            
            $this->renderView('auth/register', ['errors' => $errors, 'data' => $data]);
        } else {
            $this->renderView('auth/register');
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit;
    }

    public function forgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $user = $this->user->findByEmail($email);
            
            if ($user) {
                // Generate reset token
                $token = bin2hex(random_bytes(32));
                $this->user->update($user['id'], ['reset_token' => $token]);
                
                // Send reset email
                // TODO: Implement email sending
                
                $message = 'Password reset instructions have been sent to your email';
                $this->renderView('auth/forgot-password', ['message' => $message]);
            } else {
                $error = 'Email not found';
                $this->renderView('auth/forgot-password', ['error' => $error]);
            }
        } else {
            $this->renderView('auth/forgot-password');
        }
    }

    private function validateRegistration($data)
    {
        $errors = [];
        
        if (empty($data['name'])) {
            $errors[] = 'Name is required';
        }
        
        if (empty($data['email'])) {
            $errors[] = 'Email is required';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        } elseif ($this->user->findByEmail($data['email'])) {
            $errors[] = 'Email already exists';
        }
        
        if (empty($data['password'])) {
            $errors[] = 'Password is required';
        } elseif (strlen($data['password']) < 6) {
            $errors[] = 'Password must be at least 6 characters long';
        }
        
        return $errors;
    }
}