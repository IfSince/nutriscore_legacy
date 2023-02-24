<?php

namespace NutriScore\Decorators;

use NutriScore\AbstractController;
use NutriScore\Database;
use Throwable;

class ErrorHandlerDecorator {

    public function __construct(
        private readonly AbstractController $component,
        private readonly Database $db,
    ) { }

    public function __call($method, $args): mixed {
        try {
            return call_user_func_array([$this->component, $method], $args);
        } catch (Throwable $e) {
            $this->_dispatchException($e);
            return null;
        }
    }

    protected function _dispatchException(Throwable $e): void {
        $this->db->rollBack();
        http_response_code($e->getCode());
        var_dump($e->getMessage());

        // TODO rendern von Error Component/View über die view in component
        exit();
    }

}