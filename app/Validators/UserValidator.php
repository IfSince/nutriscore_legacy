<?php

namespace NutriScore\Validators;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Models\User\User;

class UserValidator extends AbstractValidator {
    private UserMapper $userMapper;

    public function __construct(User $user, UserMapper $userMapper = new UserMapper()) {
        parent::__construct($user);

        $this->userMapper = $userMapper;

        $this->addFieldRules(
            new ValidationRule('username', $user->getUsername(), ['required', 'minLength' =>  4, 'maxLength' => 16, 'whitespaces']),
            new ValidationRule('email', $user->getEmail(), ['required', 'minLength' => 5, 'maxLength' => 100, 'email']),
        );
    }

    public function validate(): void {
        parent::validate();

        $this->validateUserIsNewAndUsernameExists();
        $this->validateUserIsNewEmailExists();
    }

    public function validateUserIsNewAndUsernameExists(): void {
        $user = $this->userMapper->findByUsername($this->data->getUsername());
        if ($user !== null && $user->getId() !== $this->data->getId()) {
            $this->validationObject->addError('username', _('This username is already taken.'));
        }
    }

    public function validateUserIsNewEmailExists(): void {
        $user = $this->userMapper->findByEmail($this->data->getEmail());
        if ($user !== null && $user->getId() !== $this->data->getId()) {
            $this->validationObject->addError('username', _('This email is already taken.'));
        }
    }
}