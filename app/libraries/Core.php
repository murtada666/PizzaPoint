<?php

/*
    * App Core Class
    * Creates URL & loads core controllers
    * URL FORMAT - /controller/methods/params
*/

class Core
{
    // Routing is implemented on clients/index only to show how to implement routing if needed!!.
    // Routes.
    protected $routes = [
        'home' => ['controller' => 'clients', 'method' => 'index'],
        'bb' => ['controller' => 'SomeOtherController', 'method' => 'someMethod'],
    ];

    protected $currentController = 'users';
    protected $currentMethod = 'register';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();

        // Search in routes.
        if (!empty($url) && isset($this->routes[$url[0]])) {
            $route = $this->routes[$url[0]];
            // Set the controller.
            $this->currentController = $route['controller'];
            // Set the method.
            $this->currentMethod = $route['method'];
            // Require the controller.
            require_once '../app/controllers/' . $this->currentController  . '.php';
            // Instantiate controller class.
            $this->currentController = new $this->currentController;
            unset($url);

            // Search in controllers for first value (the controller).
        } else {
            if (!empty($url) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            }
            // Require the controller.
            require_once '../app/controllers/' . $this->currentController  . '.php';
            // Instantiate controller class.
            $this->currentController = new $this->currentController;
            // Check for second part of URL(Method).
            if (isset($url[1])) {
                // Check to see if method exists in controller.
                if (method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    // Unset 1 index.
                    unset($url[1]);
                }
            }
            // Get params (and because we unset the controller and the method, that means the values remaining in the array are the params only).
            $this->params = $url ? array_values($url) : [];
        }
        // Call a callback with array of params (notice that this function takes two params and NOT three).
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }


    /*
        *rtrim is being used to remove (/) on the right if exist
        *FILTER_SANITIZE_URL: remove all characters except letters
    */
    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }
}
