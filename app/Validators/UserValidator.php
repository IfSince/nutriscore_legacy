<?php

namespace NutriScore\Validators;

use NutriScore\DataMappers\UserMapper;

final class UserValidator extends AbstractValidator {
    public function __construct(
        private readonly UserMapper $userMapper,
    ) {
        parent::__construct();
    }

    public function validate(mixed $data): void {
        parent::validate($data);

        $this->validateUserIsNewAndUsernameExists();
        $this->validateUserIsNewEmailExists();
    }

    protected function setFieldRules(): void {
        $this->addFieldRules(
            new ValidationRule('username', $this->data->getUsername(), ['required', 'minLength' =>  4, 'maxLength' => 16, 'whitespaces']),
            new ValidationRule('email', $this->data->getEmail(), ['required', 'minLength' => 5, 'maxLength' => 100, 'email']),
        );
    }

    private function validateUserIsNewAndUsernameExists(): void {
        $user = $this->userMapper->findByUsername($this->data->getUsername());
        if ($user !== null && $user->getId() !== $this->data->getId()) {
            $this->validationObject->addError('username', _('This username is already taken.'));
        }
    }

    private function validateUserIsNewEmailExists(): void {
        $user = $this->userMapper->findByEmail($this->data->getEmail());
        if ($user !== null && $user->getId() !== $this->data->getId()) {
            $this->validationObject->addError('email', _('This email is already taken.'));
        }
    }
}