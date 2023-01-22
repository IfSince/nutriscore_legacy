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
        $formInput = filter_input_array(INPUT_POST);

        $validator = new RegisterFormValidator($formInput);

        $validator->setRules([
            'username' => 'required|min:4|max:16|whitespaces',
            'email' => 'required|min:3|email',
            'password' => 'required|min:8|matches:repeatPassword|uppercase|lowercase|number|specialchar|noWhitespaces',
            'repeatPassword' => 'matches:password',
            'tos' => 'required',
            'firstName' => 'required|min:2|max:100',
            'surname' => 'required|min:2|max:100',
            'gender' => 'required',
            'dateOfBirth' => 'required',
            'height' => 'required',
            'startingWeight' => 'required',
            'nutritionType' => 'required',
            'bmr' => 'required',
            'activityLevel' => 'required',
            'objective' => 'required',
        ]);

        $validator->validate();

        if ($validator->isValid()) {
            $user = new User();

            $user->register($formInput['username'], $formInput['email'], $formInput['password']);
            header('Location: /login');
        }

        $this->view->render(self::REGISTER_TEMPLATE, ['errors' => $validator->getErrors()]);
    }

}