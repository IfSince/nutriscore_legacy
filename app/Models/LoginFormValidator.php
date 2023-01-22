<?php


require_once 'FormValidator.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Database.php';

class LoginFormValidator extends FormValidator {
    private User $user;

    public function __construct(array $formInput) {
        parent::__construct($formInput);

        $this->user = new User();
    }

    public function validate(): void {
        parent::validate();

        $this->validateLoginData();
    }

    protected function validateLoginData(): void {
        $username = $this->formInput['username'];
        $passwordHash = password_hash($this->formInput['password'], PASSWORD_DEFAULT);
        $this->user->existsByUsernameAndPassword($username, $passwordHash);

        $this->errors['general'][] = 'Username or password incorrect.';
    }
}