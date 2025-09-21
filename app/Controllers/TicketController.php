<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Ticket;
use App\Models\User;

class TicketController extends Controller {
    private $ticketModel;
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->ticketModel = new Ticket();
        $this->userModel = new User();
        $this->requireAuth();
    }

    public function index() {
        $user = $this->getCurrentUser();
        $tickets = $this->ticketModel->findBy(['user_id' => $user['id']], 'created_at DESC');

        return $this->render('tickets/index', [
            'tickets' => $tickets
        ]);
    }

    public function create() {
        if ($this->isPost()) {
            $user = $this->getCurrentUser();
            $data = [
                'subject' => $this->getInput('subject'),
                'description' => $this->getInput('description'),
                'priority' => $this->getInput('priority'),
                'user_id' => $user['id'],
                'status' => 'open'
            ];

            $errors = $this->validate($data, [
                'subject' => 'required|min:5',
                'description' => 'required|min:10',
                'priority' => 'required'
            ]);

            if (empty($errors)) {
                $ticketId = $this->ticketModel->createTicket($data);
                if ($ticketId) {
                    return $this->redirect("/tickets/$ticketId");
                }
                $errors['create'] = ['Failed to create ticket'];
            }

            return $this->render('tickets/create', [
                'error' => $errors,
                'ticket' => $data
            ]);
        }

        return $this->render('tickets/create');
    }

    public function show($id) {
        $user = $this->getCurrentUser();
        $ticket = $this->ticketModel->find($id);

        if (!$ticket || ($ticket['user_id'] !== $user['id'] && !$user['is_admin'])) {
            return $this->error('Ticket not found', 404);
        }

        // Get comments for the ticket
        $comments = $this->ticketModel->getTicketComments($id);

        // Get user details for the ticket
        $ticketUser = $this->userModel->find($ticket['user_id']);
        $ticket['user_name'] = $ticketUser['name'];

        // Add user names to comments
        foreach ($comments as &$comment) {
            $commentUser = $this->userModel->find($comment['user_id']);
            $comment['user_name'] = $commentUser['name'];
        }

        return $this->render('tickets/show', [
            'ticket' => $ticket,
            'comments' => $comments
        ]);
    }

    public function addComment($ticketId) {
        if (!$this->isPost()) {
            return $this->redirect("/tickets/$ticketId");
        }

        $user = $this->getCurrentUser();
        $ticket = $this->ticketModel->find($ticketId);

        if (!$ticket || ($ticket['user_id'] !== $user['id'] && !$user['is_admin'])) {
            return $this->error('Ticket not found', 404);
        }

        $content = $this->getInput('content');
        $errors = $this->validate(['content' => $content], [
            'content' => 'required|min:2'
        ]);

        if (empty($errors)) {
            $commentId = $this->ticketModel->addComment($ticketId, $user['id'], $content);
            if ($commentId) {
                // Update ticket's updated_at timestamp
                $this->ticketModel->update($ticketId, [
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        return $this->redirect("/tickets/$ticketId");
    }

    public function close($id) {
        if (!$this->isPost()) {
            return $this->redirect("/tickets/$id");
        }

        $user = $this->getCurrentUser();
        $ticket = $this->ticketModel->find($id);

        if (!$ticket || ($ticket['user_id'] !== $user['id'] && !$user['is_admin'])) {
            return $this->error('Ticket not found', 404);
        }

        $this->ticketModel->update($id, [
            'status' => 'closed',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return $this->redirect("/tickets/$id");
    }
}