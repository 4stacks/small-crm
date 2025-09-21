<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Models\Ticket;

class AdminController extends Controller {
    private $adminModel;
    private $userModel;
    private $ticketModel;

    public function __construct() {
        $this->adminModel = new Admin();
        $this->userModel = new User();
        $this->ticketModel = new Ticket();
    }

    public function index() {
        if (!isset($_SESSION['alogin'])) {
            return $this->view('admin/login');
        }
        
        $this->redirect('/admin/home');
    }

    public function home() {
        if (!isset($_SESSION['alogin'])) {
            $this->redirect('/admin/login');
        }
        
        // Get statistics and data for dashboard
        $stats = [
            'users' => count($this->userModel->findAll()),
            'tickets' => count($this->ticketModel->findAll())
        ];
        
        return $this->view('admin/home', ['stats' => $stats]);
    }

    public function users() {
        if (!isset($_SESSION['alogin'])) {
            $this->redirect('/admin/login');
        }
        
        $users = $this->userModel->findAll();
        return $this->view('admin/users', ['users' => $users]);
    }

    public function editUser($id) {
        if (!isset($_SESSION['alogin'])) {
            $this->redirect('/admin/login');
        }
        
        $user = $this->userModel->findById($id);
        
        if ($this->isPost()) {
            $data = [
                'name' => $this->getPost('name'),
                'mobile' => $this->getPost('mobile'),
                'gender' => $this->getPost('gender')
            ];
            
            if ($this->userModel->update($id, $data)) {
                $_SESSION['msg'] = "User updated successfully";
            } else {
                $_SESSION['msg'] = "Failed to update user";
            }
            
            $this->redirect('/admin/users');
        }
        
        return $this->view('admin/edit-user', ['user' => $user]);
    }

    public function accessLogs() {
        if (!isset($_SESSION['alogin'])) {
            $this->redirect('/admin/login');
        }
        
        $logs = $this->adminModel->getUserAccessLogs();
        return $this->view('admin/access-logs', ['logs' => $logs]);
    }

    public function changePassword() {
        if (!isset($_SESSION['alogin'])) {
            $this->redirect('/admin/login');
        }
        
        if ($this->isPost()) {
            $oldPass = $this->getPost('oldpass');
            $newPass = $this->getPost('newpass');
            
            $admin = $this->adminModel->authenticate($_SESSION['alogin'], $oldPass);
            
            if ($admin) {
                if ($this->adminModel->updatePassword($admin['id'], $newPass)) {
                    $_SESSION['msg1'] = "Password changed successfully";
                } else {
                    $_SESSION['msg1'] = "Failed to change password";
                }
            } else {
                $_SESSION['msg1'] = "Old password is incorrect";
            }
            
            $this->redirect('/admin/change-password');
        }
        
        return $this->view('admin/change-password');
    }

    public function tickets() {
        if (!isset($_SESSION['alogin'])) {
            $this->redirect('/admin/login');
        }
        
        $tickets = $this->ticketModel->findAll();
        return $this->view('admin/tickets', ['tickets' => $tickets]);
    }
}