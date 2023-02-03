<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Models\User;

final class ProfileController extends AbstractController {
    private const PROFILE_TEMPLATE = 'profile/index';
    private const ACCOUNT_DATA_TEMPLATE = 'profile/account-data';
    private const PERSONAL_DATA_TEMPLATE = 'profile/personal-data';
    private const NUTRITIONAL_DATA_TEMPLATE = 'profile/nutritional-data';

    protected function beforeHook(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    protected function handleGetRequest(): void {
        $this->view->render(self::PROFILE_TEMPLATE);
    }

    public function accountData(): void {
        $this->beforeHook();
        $this->view->render(self::ACCOUNT_DATA_TEMPLATE);
    }

    public function personalData(): void {
        $this->beforeHook();
        $this->view->render(self::PERSONAL_DATA_TEMPLATE);
    }

    public function nutritionalData(): void {
        $this->beforeHook();
        $this->view->render(self::NUTRITIONAL_DATA_TEMPLATE);
    }
}