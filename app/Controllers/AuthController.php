<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Admin;

class AuthController extends Controller {
    private $userModel;
    private $adminModel;

    public function __construct() {
        $this->userModel = new User();
        $this->adminModel = new Admin();
    }

    public function login() {
        if ($this->isPost()) {
            $email = $this->getPost('email');
            $password = $this->getPost('password');
            
            $user = $this->userModel->authenticate($email, $password);
            
            if ($user) {
                $_SESSION['login'] = $email;
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                
                // Log access
                $this->logUserAccess($user);
                
                $this->redirect('/dashboard');
            } else {
                $_SESSION['action1'] = "Invalid username or password";
                $this->redirect('/login');
            }
        }
        
        return $this->view('auth/login');
    }

    public function adminLogin() {
        if ($this->isPost()) {
            $username = $this->getPost('email');
            $password = $this->getPost('password');
            
            $admin = $this->adminModel->authenticate($username, $password);
            
            if ($admin) {
                $_SESSION['alogin'] = $username;
                $_SESSION['id'] = $admin['id'];
                $this->redirect('/admin/home');
            } else {
                $_SESSION['action1'] = "Invalid username or password";
                $this->redirect('/admin/login');
            }
        }
        
        return $this->view('admin/login');
    }

    public function register() {
        if ($this->isPost()) {
            $data = [
                'name' => $this->getPost('name'),
                'email' => $this->getPost('email'),
                'password' => $this->getPost('password'),
                'mobile' => $this->getPost('phone'),
                'gender' => $this->getPost('gender')
            ];
            
            if ($this->userModel->findByEmail($data['email'])) {
                $_SESSION['error'] = "Email already registered";
                $this->redirect('/register');
            }
            
            if ($this->userModel->create($data)) {
                $_SESSION['success'] = "Registration successful. Please login.";
                $this->redirect('/login');
            }
        }
        
        return $this->view('auth/register');
    }

    public function logout() {
        session_destroy();
        $this->redirect('/login');
    }

    private function logUserAccess($user) {
        $ip = $_SERVER['REMOTE_ADDR'];
        // Get location info using geoplugin
        $geopluginURL = 'http://www.geoplugin.net/php.gp?ip=' . $ip;
        $addrDetails = unserialize(file_get_contents($geopluginURL));
        
        // Get MAC address
        ob_start();
        system('ipconfig /all');
        $mycom = ob_get_contents();
        ob_clean();
        $findme = "Physical";
        $pmac = strpos($mycom, $findme);
        $mac = substr($mycom, ($pmac + 36), 17);

        $accessData = [
            'logindate' => date("Y/m/d"),
            'logintime' => date("h:i:sa"),
            'username' => $user['name'],
            'email' => $user['email'],
            'ip' => $ip,
            'mac' => $mac,
            'city' => $addrDetails['geoplugin_city'],
            'country' => $addrDetails['geoplugin_countryName']
        ];

        $this->userModel->logAccess($user['id'], $accessData);
    }
}