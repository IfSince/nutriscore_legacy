<?php

require_once 'Router.php';

class App {
    public function __construct() {
        $router = new Router;

        $controller = $router->getController();
        $method = $router->getMethod();
        $params = $router->getParams();

        $controller = new $controller;
        $controller->{$method}(...$params);
    }
}
