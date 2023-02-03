<?php

namespace NutriScore\Models;

use NutriScore\DataMappers\UserMapper;

class LoginFormValidator extends FormValidator {
    private UserMapper $userMapper;

    public function __construct(array $formInput, UserMapper $userMapper) {
        parent::__construct($formInput);

        $this->userMapper = $userMapper;
    }

    public function validate(): void {
        parent::validate();

        $this->validateLoginData($this->formInput['username']);
    }

    private function validateLoginData(string $username): void {
        $user = $this->userMapper->findByUsername($username);
        $passwordVerify = password_verify($this->formInput['password'], $user?->getPassword());

        if ($user === null || !$passwordVerify) {
            $this->errors['general'][] = 'Username or password incorrect.';
        }
    }
}