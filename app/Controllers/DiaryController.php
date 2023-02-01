<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;

final class DiaryController extends AbstractController {
    private const DIARY_TEMPLATE = 'diary/index';

    protected function handleGetRequest(): void {
        $userId = $_SESSION['userId'];

        $this->view->render(self::DIARY_TEMPLATE);
    }
}