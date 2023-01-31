<?php

namespace NutriScore\Controllers;

use JetBrains\PhpStorm\NoReturn;
use NutriScore\AbstractController;
use NutriScore\Models\RegisterFormValidator;
use NutriScore\Models\User;

class RegisterController extends AbstractController {
    private const REGISTER_TEMPLATE = 'register/index';

    #[NoReturn]
    protected function handleGetRequest(): void {
        $this->view->render(self::REGISTER_TEMPLATE);
    }

    #[NoReturn]
    protected function handlePostRequest(): void {
        $formInput = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

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