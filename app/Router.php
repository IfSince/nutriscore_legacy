<?php

namespace NutriScore;

use NutriScore\Controllers\LoginController;
use NutriScore\Controllers\NotFoundController;

class Router {
    private string $controller = LoginController::class;
    private string $method = 'index';
    private array $params = [];

    public function __construct() {
        $url = $this->parseUrl();
        if (!$url) {
            return;
        }

        $requestedController = 'NutriScore\\Controllers\\' . ucfirst(strtolower($url[0])) . 'Controller';

        if (!class_exists($requestedController)) {
            $this->controller = NotFoundController::class;
            return;
        }

        $this->controller = $requestedController;
        unset($url[0]);

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
