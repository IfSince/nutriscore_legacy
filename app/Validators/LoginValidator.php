<?php

namespace NutriScore\Validators;

use NutriScore\DataMappers\UserMapper;

class LoginValidator extends AbstractValidator {
    private Usermapper $userMapper;

    public function __construct(array $formInput, UserMapper $userMapper) {
        parent::__construct($formInput);

        $this->userMapper = $userMapper;
    }

    public function validate(): void {
        parent::validate();

        $this->validateLoginData();
    }

    private function validateLoginData(): void {
        $username = $this->data['username'] ?? null;
        $password = $this->data['password'] ?? null;

        $user = $this->userMapper->findByUsername($username);
        $passwordVerify = password_verify($password, $user?->getPassword());

        if ($user === null || !$passwordVerify) {
            $this->validationObject->addError('root', _('The username or password is incorrect'));
        }
    }
}