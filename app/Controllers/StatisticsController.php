<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Models\User\User;

class StatisticsController extends AbstractController {
    private const STATISTICS_TEMPLATE = 'statistics/index';

    protected function preAuthorize(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    protected function getRequest(): void {
        $this->view->render(self::STATISTICS_TEMPLATE);
    }

}