<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Models\User\User;

final class DiaryController extends AbstractController {
    private const DIARY_TEMPLATE = 'diary/index';

    protected function beforeHook(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    protected function handleGetRequest(): void {
        $this->view->render(self::DIARY_TEMPLATE);
    }
}