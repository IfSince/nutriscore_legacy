<?php

namespace NutriScore\Models;

class LoginFormValidator extends FormValidator {
    private User $user;

    public function __construct(array $formInput) {
        parent::__construct($formInput);

        $this->user = new User();
    }

    public function validate(): void {
        parent::validate();

        $this->validateLoginData($this->formInput['username']);
    }

    private function validateLoginData(string $username): void {
        $user = $this->user->findByUsernameAndFetch($username);
        $passwordVerify = password_verify($this->formInput['password'], $this->user->getPassword());

        if (empty($user) || !$passwordVerify) {
            $this->errors['general'][] = 'Username or password incorrect.';
        }
    }
}