<?php

use JetBrains\PhpStorm\NoReturn;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'AbstractController.php';

class OverviewController extends AbstractController {
    private const OVERVIEW_TEMPLATE = 'overview/index';

    #[NoReturn]
    protected function handleGetRequest(): void {
        $userId = $_SESSION['userId'];

        $this->view->render(self::OVERVIEW_TEMPLATE);
    }
}