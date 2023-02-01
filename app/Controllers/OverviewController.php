<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;

final class OverviewController extends AbstractController {
    private const OVERVIEW_TEMPLATE = 'overview/index';

    protected function handleGetRequest(): void {
        $userId = $_SESSION['userId'];

        $this->view->render(self::OVERVIEW_TEMPLATE);
    }
}