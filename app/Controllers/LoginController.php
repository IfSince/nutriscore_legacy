<?php

use JetBrains\PhpStorm\NoReturn;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'AbstractController.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'LoginFormValidator.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Database.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'User.php';

class LoginController extends AbstractController {
    private const LOGIN_TEMPLATE = 'login/index';

    #[NoReturn]
    protected function handleGetRequest(): void {
        $this->view->render(self::LOGIN_TEMPLATE);
    }

    #[NoReturn]
    protected function handlePostRequest(): void {
        $formInput = $_POST;
        $validation = new LoginFormValidator($formInput);

        $validation->setRules([
            'username' => 'required|min:3',
            'password' => 'required|min:2',
        ]);

        $validation->validate();

        if (!$validation->isValid()) {
            $this->view->render(self::LOGIN_TEMPLATE, [
                'errors' => $validation->getErrors()
            ]);
        }

        // User Einloggen
        $db = new Database;
        $user = new User($db);
        try {
            $user->login($formInput['username'], $formInput['password']);
            header('Location: /overview');
        } catch (Exception $e) {
            $this->view->render(self::LOGIN_TEMPLATE, [
                'errors' => [
                    'root' => [$e->getMessage()]
                ]
            ]);
        }
    }
}
