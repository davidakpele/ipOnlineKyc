<?php

class Application {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $this->parseUrl();

        if (file_exists('../app/controllers/' . $this->controller . '.php')) {
            require_once '../app/controllers/' . $this->controller . '.php';
            $this->controller = new $this->controller();
        } else {
            // Controller not found, set to a default or error controller
            echo "Controller not found.";
            return;
        }

        if (method_exists($this->controller, $this->method)) {
            call_user_func_array([$this->controller, $this->method], $this->params);
        } else {
            // Method not found, you can set a default or error method
            echo "Method not found.";
            return;
        }
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->controller = isset($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
            $this->method = isset($url[1]) ? $url[1] : 'index';
            unset($url[0], $url[1]);

            $this->params = $url ? array_values($url) : [];
        }
    }
}

?>
