<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Quote;

class QuoteController extends Controller {
    private $quoteModel;

    public function __construct() {
        $this->quoteModel = new Quote();
    }

    public function create() {
        if (!isset($_SESSION['login'])) {
            $this->redirect('/login');
        }

        if ($this->isPost()) {
            $services = $this->getPost('services') ?? [];
            
            $data = [
                'name' => $this->getPost('name'),
                'email' => $this->getPost('email'),
                'contactno' => $this->getPost('contact'),
                'company' => $this->getPost('company'),
                'query' => $this->getPost('query') ?? ''
            ];
            
            // Map services to database fields
            $serviceMap = [
                'Website Design & Development' => 'wdd',
                'Content Management System' => 'cms',
                'Search Engine Optimization' => 'seo',
                'Social Media Marketing' => 'smo',
                'Mobile App Development' => 'swd',
                'E-commerce Solutions' => 'ed'
            ];
            
            foreach ($serviceMap as $service => $field) {
                $data[$field] = in_array($service, $services) ? $service : '';
            }
            
            if ($this->quoteModel->createQuote($data)) {
                $_SESSION['success'] = "Quote request submitted successfully";
            } else {
                $_SESSION['error'] = "Failed to submit quote request";
            }
            
            $this->redirect('/quotes/create');
        }
        
        return $this->view('quote/create');
    }

    public function adminList() {
        if (!isset($_SESSION['alogin'])) {
            $this->redirect('/admin/login');
        }

        $quotes = $this->quoteModel->getQuotes();
        return $this->view('admin/quotes/list', ['quotes' => $quotes]);
    }

    public function adminView($id) {
        if (!isset($_SESSION['alogin'])) {
            $this->redirect('/admin/login');
        }

        $quote = $this->quoteModel->getQuoteDetails($id);
        
        if ($quote) {
            return $this->view('admin/quotes/view', ['quote' => $quote]);
        }
        
        $this->redirect('/admin/quotes');
    }
}