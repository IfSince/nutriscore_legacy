<?php

namespace NutriScore\Validators;

use NutriScore\Models\Person\Person;

class PersonValidator extends AbstractValidator {

    public function __construct(Person $person) {
        parent::__construct($person);

        $this->addFieldRules(
            new ValidationRule('firstName', $this->data->getFirstName(), ['required', 'minLength'  => 2, 'maxLength' => 100]),
            new ValidationRule('surname', $this->data->getSurname(), ['required', 'minLength'  => 2, 'maxLength' => 100]),
            new ValidationRule('gender', $this->data->getGender() ?? null, ['required']),
            new ValidationRule('dateOfBirth', $this->data->getDateOfBirth(), ['required']),
            new ValidationRule('height', $this->data->getHeight(), ['required']),
        );
    }

}