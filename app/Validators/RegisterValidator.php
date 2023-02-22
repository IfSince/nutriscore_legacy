<?php

namespace NutriScore\Validators;

class RegisterValidator extends AbstractValidator {

    public function setFieldRules(): void {
        $this->addFieldRules(
            new ValidationRule('password', $this->data['password'], [
                    'required',
                    'minLength' => 8,
                    'matches' => $this->data['repeatPassword'],
                    'uppercase',
                    'lowercase',
                    'number',
                    'specialchar',
                    'noWhitespaces'
                ]
            ),
            new ValidationRule('repeatPassword', $this->data['repeatPassword'], ['required', 'matches' => $this->data['password']]),
        );
    }
}