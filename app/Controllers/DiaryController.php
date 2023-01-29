<?php

namespace NutriScore\Controllers;

use JetBrains\PhpStorm\NoReturn;
use NutriScore\AbstractController;

class DiaryController extends AbstractController {
    private const DIARY_TEMPLATE = 'diary/index';

    #[NoReturn]
    protected function handleGetRequest(): void {
        $userId = $_SESSION['userId'];

        $this->view->render(self::DIARY_TEMPLATE);
    }
}