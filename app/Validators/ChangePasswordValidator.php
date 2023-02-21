<?php

namespace NutriScore\Validators;

use NutriScore\Models\User\User;

class ChangePasswordValidator extends AbstractValidator {
    private User $user;

    public function __construct(array $data, $user) {
        parent::__construct($data);

        $this->user = $user;

        $this->addFieldRules(
            new ValidationRule('password', $this->data['password'], ['required']),
            new ValidationRule('repeatPassword', $this->data['repeatPassword'], ['required', 'matches' => $this->data['newPassword']]),
            new ValidationRule('newPassword', $this->data['newPassword'], [
                'required',
                'minLength' => 8,
                'uppercase',
                'lowercase',
                'number',
                'specialchar',
                'noWhitespaces'
            ])
        );
    }


    public function validate(): void {
        parent::validate();

        $this->validateOldPasswordCorrect();
    }

    private function validateOldPasswordCorrect(): void {
        if (!password_verify($this->data['password'], $this->user->getPassword())) {
            $this->validationObject->addError('password', _('The password is not correct'));
        }
    }

}