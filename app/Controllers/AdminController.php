<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\User;
use App\Models\Ticket;
use App\Models\ActivityLog;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // Ensure user is authenticated and is an admin
        if (!$this->auth->isAuthenticated() || !$this->auth->isAdmin()) {
            $this->redirect('/login');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'totalUsers' => (new User())->count(),
            'totalTickets' => (new Ticket())->count(),
            'recentActivity' => (new ActivityLog())->getRecent(5)
        ];

        return $this->view('admin/dashboard', $data);
    }

    public function users()
    {
        $data = [
            'title' => 'Manage Users',
            'users' => (new User())->all()
        ];

        return $this->view('admin/users', $data);
    }

    public function tickets()
    {
        $data = [
            'title' => 'Manage Tickets',
            'tickets' => (new Ticket())->all()
        ];

        return $this->view('admin/tickets', $data);
    }

    public function activity()
    {
        $data = [
            'title' => 'Activity Logs',
            'logs' => (new ActivityLog())->all()
        ];

        return $this->view('admin/activity', $data);
    }

    public function settings()
    {
        $data = [
            'title' => 'System Settings',
            'settings' => $this->getSystemSettings()
        ];

        return $this->view('admin/settings', $data);
    }

    private function getSystemSettings()
    {
        // TODO: Implement system settings retrieval
        return [
            'site_name' => 'Small CRM',
            'timezone' => 'UTC',
            'maintenance_mode' => false
        ];
    }
}
