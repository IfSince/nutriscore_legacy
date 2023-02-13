<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;

final class NotFoundController extends AbstractController {
    private const NOT_FOUND_TEMPLATE = 'not-found/index';

    protected function getRequest(): void {
        $this->view->render(self::NOT_FOUND_TEMPLATE);
    }
}