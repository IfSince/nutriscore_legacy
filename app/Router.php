<?php

class Router {
    private string $controller = 'LoginController';
    private string $method = 'index';
    private array $params;

    public function __construct() {
        $url = $this->parseUrl();

        $controllerName = $url[0] ?? '';
        $requestedController = ucfirst(strtolower($controllerName)) . 'Controller';
        $controllerPath = __DIR__ . DIRECTORY_SEPARATOR . "Controllers" . DIRECTORY_SEPARATOR . "{$requestedController}.php";

        if ($url && file_exists($controllerPath)) {
            require_once $controllerPath;
            $this->controller = $requestedController;
            unset($url[0]);
        } else {
            require_once __DIR__ . DIRECTORY_SEPARATOR . "Controllers" . DIRECTORY_SEPARATOR . "{$this->controller}.php";
        }

        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        $this->params = array_values($url);
    }

    public function getController(): string {
        return $this->controller;
    }

    public function getMethod(): string {
        return $this->method;
    }

    public function getParams(): array {
        return $this->params;
    }

    private function parseUrl(): array {
        if (!isset($_GET['url'])) {
            return [];
        }

        return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
    }
}
