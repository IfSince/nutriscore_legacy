<?php

namespace NutriScore\Controllers;

use JetBrains\PhpStorm\NoReturn;
use NutriScore\AbstractController;

class NotFoundController extends AbstractController {
    private const NOT_FOUND_TEMPLATE = 'notFound/index';


    #[NoReturn]
    protected function handleGetRequest(): void {
        $this->view->render(self::NOT_FOUND_TEMPLATE);
    }
}