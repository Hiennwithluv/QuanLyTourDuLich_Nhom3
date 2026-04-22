<?php
class App {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();
        $controllerPath = '../app/controllers/';

        // Kiểm tra nếu là route admin
        if (isset($url[0]) && strtolower($url[0]) === 'admin') {
            $controllerPath = '../app/controllers/admin/';
            array_shift($url); 
            if (isset($url[0])) {
                $controllerName = ucfirst($url[0]) . 'Controller';
                if (file_exists($controllerPath . $controllerName . '.php')) {
                    $this->controller = $controllerName;
                    unset($url[0]);
                } else {
                    $this->controller = 'DashboardController'; 
                }
            } else {
                $this->controller = 'DashboardController';
            }
        } else if (isset($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            if (file_exists($controllerPath . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }

        require_once $controllerPath . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}