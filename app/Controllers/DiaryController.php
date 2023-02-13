<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Models\User\User;

final class DiaryController extends AbstractController {
    private const DIARY_TEMPLATE = 'diary/index';

    protected function preAuthorize(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    protected function getRequest(): void {
        $this->view->render(self::DIARY_TEMPLATE);
    }
}