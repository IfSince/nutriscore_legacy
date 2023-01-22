<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'AbstractController.php';

class OverviewController extends AbstractController {
    protected function handleGetRequest(): void {
        echo "Login successful for user with id {$_SESSION['userId']}";
    }
}