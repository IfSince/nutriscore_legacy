<?php

namespace NutriScore\Validators;

use NutriScore\DataMappers\UserMapper;

final class LoginValidator extends AbstractValidator {

    public function __construct(
        private readonly Usermapper $userMapper,
    ) {
        parent::__construct();
    }

    public function validate(mixed $data): void {
        parent::validate($data);

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