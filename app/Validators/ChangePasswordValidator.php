<?php

namespace NutriScore\Validators;

final class ChangePasswordValidator extends AbstractValidator {

    public function validate(mixed $data): void {
        parent::validate($data);

        $this->validateOldPasswordCorrect();
    }

    protected function setFieldRules(): void {
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

    private function validateOldPasswordCorrect(): void {
        if (!password_verify($this->data['password'], $this->data['user']->getPassword())) {
            $this->validationObject->addError('password', _('The password is not correct'));
        }
    }
}