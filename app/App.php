<?php

namespace NutriScore;

use NutriScore\Decorators\ErrorHandlerDecorator;

class App {
    private Database $db;

    public function init(): void {
        // Init Autowired Dependency Injection Container
        $container = new DIContainer();
        $this->setLanguage('de_DE');

        $this->db = new Database();
        $container->set($this->db);
        $this->db->beginTransaction();

        $router = $container->get(Router::class);
        $request = $container->get(Request::class, ['pageParams' => $router->getParams()]);

        $controller = $container->get($router->getController());
        $controller->setRequest(($request));

        $errorHandlerDecorator = new ErrorHandlerDecorator($controller, $this->db);
        $errorHandlerDecorator->{$router->getMethod()}();
    }

    public function __destruct() {
        $this->commitTransaction();
    }

    private function setLanguage(string $language): void {
        putenv("LANG=$language");
        setlocale(LC_ALL, $language);

        $domain = 'translation';
        bindtextdomain($domain, 'locale');
        textdomain($domain);
        bind_textdomain_codeset($domain, 'UTF-8');
    }

    private function commitTransaction(): void {
        if (isset($this->db) && $this->db->inTransaction()) {
            $this->db->commit();
        }
    }
}
