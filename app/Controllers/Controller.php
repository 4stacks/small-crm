<?php

namespace App\Controllers;

/**
 * Base Controller
 */
abstract class Controller
{
    /**
     * Parameters from the matched route
     * @var array
     */
    protected $route_params = [];

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->route_params = [];
    }

    /**
     * Render a view
     * @param string $view The view file
     * @param array $args Arguments to pass to the view
     * @return void
     */
    protected function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = dirname(__DIR__) . "/Views/$view.php";

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }
}