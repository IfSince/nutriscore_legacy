<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'AbstractController.php';

class DiaryController extends AbstractController {
    private const DIARY_TEMPLATE = 'diary/index';

    protected function handleGetRequest(): void {
        $userId = $_SESSION['userId'];

        $this->view->render(self::DIARY_TEMPLATE);
    }
}