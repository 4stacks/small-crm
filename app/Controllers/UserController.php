<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Quote;

class UserController extends Controller {
    private $userModel;
    private $ticketModel;
    private $quoteModel;

    public function __construct() {
        $this->userModel = new User();
        $this->ticketModel = new Ticket();
        $this->quoteModel = new Quote();
    }

    public function dashboard() {
        if (!isset($_SESSION['login'])) {
            $this->redirect('/login');
        }

        $email = $_SESSION['login'];
        $tickets = $this->ticketModel->getTicketsByEmail($email);
        
        $totalTickets = count($tickets);
        $openTickets = 0;
        $closedTickets = 0;
        
        foreach ($tickets as $ticket) {
            if ($ticket['status'] == 'Open') {
                $openTickets++;
            } else {
                $closedTickets++;
            }
        }

        // Get quote count
        $quotes = $this->quoteModel->getQuotes();
        $totalQuotes = count($quotes);

        return $this->view('user/dashboard', [
            'totalTickets' => $totalTickets,
            'openTickets' => $openTickets,
            'closedTickets' => $closedTickets,
            'totalQuotes' => $totalQuotes
        ]);
    }

    public function profile() {
        if (!isset($_SESSION['login'])) {
            $this->redirect('/login');
        }

        $user = $this->userModel->findByEmail($_SESSION['login']);
        
        if ($this->isPost()) {
            $data = [
                'name' => $this->getPost('name'),
                'mobile' => $this->getPost('phone'),
                'gender' => $this->getPost('gender')
            ];
            
            if ($this->userModel->update($user['id'], $data)) {
                $_SESSION['msg'] = "Profile updated successfully";
            } else {
                $_SESSION['msg'] = "Failed to update profile";
            }
            
            $this->redirect('/profile');
        }
        
        return $this->view('user/profile', ['user' => $user]);
    }

    public function changePassword() {
        if (!isset($_SESSION['login'])) {
            $this->redirect('/login');
        }

        if ($this->isPost()) {
            $oldPass = $this->getPost('oldpass');
            $newPass = $this->getPost('newpass');
            
            $user = $this->userModel->authenticate($_SESSION['login'], $oldPass);
            
            if ($user) {
                if ($this->userModel->updatePassword($user['id'], $newPass)) {
                    $_SESSION['msg1'] = "Password changed successfully";
                } else {
                    $_SESSION['msg1'] = "Failed to change password";
                }
            } else {
                $_SESSION['msg1'] = "Old password is incorrect";
            }
            
            $this->redirect('/change-password');
        }
        
        return $this->view('user/change-password');
    }
}