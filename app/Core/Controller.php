<?php
namespace App\Core;

class Controller {
    protected $auth;

    public function __construct() {
        $this->auth = new Auth();
    }

    protected function view($name, $data = []) {
        // Make view helper functions available
        $data['view'] = $this;
        
        // Extract data to make variables available in view
        extract($data);
        
        // Get the view content
        $viewPath = __DIR__ . "/../Views/{$name}.php";
        if (!file_exists($viewPath)) {
            throw new \Exception("View {$name} not found");
        }
        
        // Start output buffering
        ob_start();
        
        // Check if this is a nested view call
        if (!defined('VIEW_RENDERING')) {
            // Mark that we're rendering a view to prevent nested layout loading
            define('VIEW_RENDERING', true);
            
            // Load header
            include __DIR__ . "/../Views/layouts/header.php";
        }
        
        // Load the view
        include $viewPath;
        
        // If this is the main view, include footer and clean up
        if (!defined('VIEW_RENDERING_COMPLETE')) {
            // Load footer
            include __DIR__ . "/../Views/layouts/footer.php";
            
            // Mark rendering as complete
            define('VIEW_RENDERING_COMPLETE', true);
        }
        
        // Return the buffered content
        return ob_get_clean();
    }

    protected function includeView($path) {
        $fullPath = __DIR__ . "/../Views/{$path}.php";
        if (!file_exists($fullPath)) {
            throw new \Exception("Include view {$path} not found");
        }
        require_once $fullPath;
    }

    protected function redirect($url) {
        header("Location: {$url}");
        exit();
    }

    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function getPost($key = null) {
        if ($key === null) {
            return $_POST;
        }
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    protected function getQuery($key = null) {
        if ($key === null) {
            return $_GET;
        }
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }
}