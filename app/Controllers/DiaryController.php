<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Models\User\User;
use NutriScore\Utils\Session;

final class DiaryController extends AbstractController {
    private const DIARY_TEMPLATE = 'diary/index';

    protected function beforeHook(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    protected function handleGetRequest(): void {
        Session::delete('id');
        $this->view->render(self::DIARY_TEMPLATE);
    }
}