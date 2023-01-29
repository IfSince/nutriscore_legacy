<?php

namespace NutriScore;

class App {
    public function __construct() {
        $this->autoloadClasses();

        $router = new Router();

        $controller = $router->getController();
        $method = $router->getMethod();
        $params = $router->getParams();

        $controller = new $controller;
        $controller->{$method}(...$params);
    }

    private function autoloadClasses(): void {
        spl_autoload_register(function ($namespace) {
            $projectNamespace = 'NutriScore\\';
            $className = str_replace($projectNamespace, '', $namespace);
            $filePath = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

            if (file_exists($filePath)) {
                require_once $filePath;
            }
        });
    }
}
