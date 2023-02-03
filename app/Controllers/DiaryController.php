<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Models\User;

final class DiaryController extends AbstractController {
    private const DIARY_TEMPLATE = 'diary/index';

    protected function handleGetRequest(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
        $this->view->render(self::DIARY_TEMPLATE);
    }
}