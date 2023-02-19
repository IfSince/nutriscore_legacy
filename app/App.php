<?php

namespace NutriScore;

class App {
    public function __construct() {
        $language = 'de_DE';
        putenv("LANG=$language");
        setlocale(LC_ALL, $language);

        $domain = 'translation';
        bindtextdomain($domain, 'locale');
        textdomain($domain);
        bind_textdomain_codeset($domain, 'UTF-8');

        $router = new Router();

        $controller = $router->getController();
        $method = $router->getMethod();
        $params = $router->getParams();


        $request = new Request($params);
        $controller = new $controller($request);
        $controller->{$method}();
    }
}
