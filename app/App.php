<?php

namespace NutriScore;

class App {
    public function __construct() {
        $router = new Router();

        $controller = $router->getController();
        $method = $router->getMethod();
        $params = $router->getParams();


        $request = new Request($params);
        $controller = new $controller($request);
        $controller->{$method}();
    }
}
