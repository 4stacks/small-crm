<?php
namespace App\Core;

/**
 * Router Class
 */
class Router
{
    /**
     * Routes array
     * @var array
     */
    private $routes = [];

    /**
     * Parameters array
     * @var array
     */
    private $params = [];

    /**
     * Add a route
     * @param string $route
     * @param array $params
     */
    public function add($route, $params = [])
    {
        $this->routes[$route] = $params;
    }

    /**
     * Match the route to the routes in the routing table
     * @param string $url
     * @return boolean
     */
    private function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if ($url === $route) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * Dispatch the route, creating the controller object and running the
     * action method
     * @param string $url
     * @return void
     */
    public function dispatch($url)
    {
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = "App\\Controllers\\{$controller}Controller";

            if (class_exists($controller)) {
                $controller_object = new $controller();
                $action = $this->params['action'];

                if (method_exists($controller_object, $action)) {
                    $controller_object->$action();
                } else {
                    throw new \Exception("Method $action not found in controller $controller");
                }
            } else {
                throw new \Exception("Controller class $controller not found");
            }
        } else {
            throw new \Exception('No route matched.', 404);
        }
    }
}