<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Ticket;

class TicketController extends Controller {
    private $ticketModel;

    public function __construct() {
        $this->ticketModel = new Ticket();
    }

    public function index() {
        if (!isset($_SESSION['login'])) {
            $this->redirect('/login');
        }

        $tickets = $this->ticketModel->getTicketsByEmail($_SESSION['login']);
        return $this->view('ticket/index', ['tickets' => $tickets]);
    }

    public function create() {
        if (!isset($_SESSION['login'])) {
            $this->redirect('/login');
        }

        if ($this->isPost()) {
            $data = [
                'email_id' => $_SESSION['login'],
                'subject' => $this->getPost('subject'),
                'task_type' => $this->getPost('tasktype'),
                'prioprity' => $this->getPost('priority'),
                'ticket' => $this->getPost('description')
            ];
            
            if ($this->ticketModel->createTicket($data)) {
                $_SESSION['msg'] = "Ticket created successfully";
                $this->redirect('/tickets');
            } else {
                $_SESSION['msg'] = "Failed to create ticket";
                $this->redirect('/tickets/create');
            }
        }
        
        return $this->view('ticket/create');
    }

    public function view($id) {
        if (!isset($_SESSION['login'])) {
            $this->redirect('/login');
        }

        $ticket = $this->ticketModel->findById($id);
        
        if ($ticket && $ticket['email_id'] === $_SESSION['login']) {
            return $this->view('ticket/view', ['ticket' => $ticket]);
        }
        
        $this->redirect('/tickets');
    }
}