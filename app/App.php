<?php

namespace NutriScore;

use NutriScore\Decorators\ErrorHandlerDecorator;

class App {
    public function __construct() {
        $language = 'de_DE';
        putenv("LANG=$language");
        setlocale(LC_ALL, $language);

        $domain = 'translation';
        bindtextdomain($domain, 'locale');
        textdomain($domain);
        bind_textdomain_codeset($domain, 'UTF-8');

        $container = new DIContainer();

        $router = $container->get(Router::class);

        $controller = $router->getController();
        $method = $router->getMethod();
        $params = $router->getParams();

        $request = $container->get(Request::class, ['pageParams' => $params]);
        $controller = $container->get($controller);
        $controller->setRequest(($request));

        $errorHandlerDecorator = new ErrorHandlerDecorator($controller);
        $errorHandlerDecorator->{$method}();
    }
}
