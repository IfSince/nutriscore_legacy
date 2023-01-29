<?php

namespace NutriScore\Controllers;

use JetBrains\PhpStorm\NoReturn;
use NutriScore\AbstractController;
use NutriScore\Models\LoginFormValidator;
use NutriScore\Models\User;

class LoginController extends AbstractController {
    private const LOGIN_TEMPLATE = 'login/index';

    #[NoReturn]
    protected function handleGetRequest(): void {
        $this->view->render(self::LOGIN_TEMPLATE);
    }

    #[NoReturn]
    protected function handlePostRequest(): void {
        $formInput = filter_input_array(INPUT_POST);

        $validator = new LoginFormValidator($formInput);
        $validator->validate();

        if ($validator->isValid()) {
            $user = new User();
            $user->login($formInput['username']);

            header('Location: /overview');
        } else {
            $this->view->render(self::LOGIN_TEMPLATE, ['errors' => $validator->getErrors()]);
        }
    }
}
