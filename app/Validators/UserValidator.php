<?php

namespace NutriScore\Validators;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Models\User\User;

class UserValidator extends AbstractValidator {
    private UserMapper $userMapper;

    public function __construct(User $user, UserMapper $userMapper) {
        parent::__construct($user);

        $this->userMapper = $userMapper;

        $this->addFieldRules(
            new ValidationRule('username', $user->getUsername(), ['required', 'minLength' => 3]),
            new ValidationRule('email', $user->getEmail(), ['required', 'email']),
        );
    }

    public function validate(): void {
        parent::validate();

        $this->validateUsernameExists();
        $this->validateEmailExists();
    }

    public function validateUsernameExists(): void {
        $user = $this->userMapper->findByUsername($this->data->getUsername());
        if ($user !== null && $user->getId() !== $this->data->getId()) {
            $this->validationObject->addError('username', 'This username is already taken.');
        }
    }

    public function validateEmailExists(): void {
        $user = $this->userMapper->findByEmail($this->data->getEmail());
        if ($user !== null && $user->getId() !== $this->data->getId()) {
            $this->validationObject->addError('username', 'This email is already taken.');
        }
    }
}