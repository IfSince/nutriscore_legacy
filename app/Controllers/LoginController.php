<?php

use JetBrains\PhpStorm\NoReturn;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'AbstractController.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'LoginFormValidator.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'User.php';

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
            $this->view->render(self::LOGIN_TEMPLATE, [ 'errors' => $validator->getErrors()]);
        }
    }
}
