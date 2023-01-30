<?php

namespace NutriScore\Controllers;

use JetBrains\PhpStorm\NoReturn;
use NutriScore\AbstractController;
use NutriScore\Helpers\Session;

class ProfileController extends AbstractController {
    private const PROFILE_TEMPLATE = 'profile/index';

    #[NoReturn]
    protected function handleGetRequest(): void {
        $userId = Session::get('userId');

        $this->view->render(self::PROFILE_TEMPLATE);
    }
}