<?php

use JetBrains\PhpStorm\NoReturn;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'AbstractController.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'RegisterFormValidator.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Database.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'User.php';

class RegisterController extends AbstractController {
    private const REGISTER_TEMPLATE = 'register/index';

    #[NoReturn]
    protected function handleGetRequest(): void {
        $this->view->render(self::REGISTER_TEMPLATE);
    }

    #[NoReturn]
    protected function handlePostRequest(): void {
        $formInput = $_POST;
        $validation = new RegisterFormValidator($formInput);

        $validation->setRules([
            'username' => 'required|min:3|exists',
            'email' => 'required|min:3',
            'password' => 'password'
        ]);

        $validation->validate();

        $this->view->render(self::REGISTER_TEMPLATE);


//        if (!$validation->isValid()) {
//            $this->view->render(
//                view: self::REGISTER_TEMPLATE,
//                data: [ 'errors' => $validation->getErrors() ]
//            );
//        }
//
//        $db = new Database();
//        $user = new User($db);
//
//        try {
//            $user->register(
//                $formInput['username'],
//                $formInput['email'],
//                $formInput['password'],
//            );
//
////            header('Location: /login');
//        } catch (Exception $e) {
//            $this->view->render(
//                view: self::REGISTER_TEMPLATE,
//                data: [ 'errors' => [$e->getMessage()] ]
//            );
//        }
    }

}