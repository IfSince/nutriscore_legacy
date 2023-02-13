<?php

namespace NutriScore\Validators;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Models\User\User;

class UserValidator extends AbstractValidator {
    private User $user;
    private UserMapper $userMapper;

    public function __construct(User $user, UserMapper $userMapper) {
        parent::__construct();

        $this->userMapper = $userMapper;

        $this->user = $user;
        $this->validationObject->setData($user);

        $this->addFieldRules(
            new ValidationRule('username', $user->getUsername(), ['required', 'minLength' => 3]),
            new ValidationRule('email', $user->getEmail(), ['required', 'email']),
        );
    }

    public function validate(): void {
        parent::validate();

        $this->validateUsernameExists();
    }

    public function validateUsernameExists(): void {
        if ($this->userMapper->findByUsername($this->user->getUsername())) {
            $this->validationObject->addMessage('username', "This username already exists.");
        }
    }
}