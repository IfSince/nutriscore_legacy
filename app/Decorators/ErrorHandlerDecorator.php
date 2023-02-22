<?php

namespace NutriScore\Decorators;

use Exception;
use NutriScore\AbstractController;

class ErrorHandlerDecorator {
    private AbstractController $component;

    public function __construct(AbstractController $component) {
        $this->component = $component;
    }

    public function __call($method, $args): mixed {
        try {
            return call_user_func_array([$this->component, $method], $args);
        } catch (Exception $e) {
            $this->_dispatchException($e);
            return null;
        }
    }

    protected function _dispatchException(Exception $e): void {
        http_response_code($e->getCode());
        var_dump($e->getMessage());
        exit();
    }

}