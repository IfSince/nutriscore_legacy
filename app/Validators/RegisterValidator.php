<?php

namespace NutriScore\Validators;

class RegisterValidator extends AbstractValidator {
    public function __construct(array $formInput) {
        parent::__construct($formInput);

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
            new ValidationRule('repeatPassword', $this->data['repeatPassword'], ['matches' => $this->data['password']]),
        );
    }
}