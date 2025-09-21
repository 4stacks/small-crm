<?php

class View {
    private $layout = 'default';

    public function render($view, $data = []) {
        // Extract the data into variables
        extract($data);
        
        // Start output buffering
        ob_start();
        
        // Include the view file
        $viewFile = APP_ROOT . "/Views/{$view}.php";
        if (!file_exists($viewFile)) {
            throw new Exception("View file not found: $view");
        }
        
        require $viewFile;
        $content = ob_get_clean();
        
        // Render the layout with the content
        if ($this->layout) {
            $layoutFile = APP_ROOT . "/Views/layouts/{$this->layout}.php";
            if (!file_exists($layoutFile)) {
                throw new Exception("Layout file not found: {$this->layout}");
            }
            
            require $layoutFile;
        } else {
            echo $content;
        }
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function partial($name, $data = []) {
        extract($data);
        
        $partialFile = APP_ROOT . "/Views/partials/{$name}.php";
        if (!file_exists($partialFile)) {
            throw new Exception("Partial not found: $name");
        }
        
        require $partialFile;
    }

    public function escape($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    public function url($path) {
        return Config::get('app.url') . '/' . ltrim($path, '/');
    }

    public function asset($path) {
        return $this->url('assets/' . ltrim($path, '/'));
    }
}