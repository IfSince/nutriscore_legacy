<?php

namespace NutriScore\Validators;

use NutriScore\Models\Person\ActivityLevel;
use NutriScore\Models\Person\NutritionType;
use NutriScore\Models\Person\Person;

class PersonValidator extends AbstractValidator {

    public function __construct(Person $person) {
        parent::__construct($person);

        $this->addFieldRules(
            new ValidationRule('firstName', $person->getFirstName(), ['required', 'minLength'  => 2, 'maxLength' => 100]),
            new ValidationRule('surname', $person->getSurname(), ['required', 'minLength'  => 2, 'maxLength' => 100]),
            new ValidationRule('gender', $person->getGender() ?? null, ['required']),
            new ValidationRule('dateOfBirth', $person->getDateOfBirth(), ['required']),
            new ValidationRule('height', $person->getHeight(), ['required']),
            new ValidationRule('nutritionType', $person->getNutritionType(), ['required']),
            new ValidationRule('bmrCalculationType', $person->getBmrCalculationType(), ['required']),
            new ValidationRule('activityLevel', $person->getActivityLevel(), ['required']),
            new ValidationRule('goal', $person->getGoal(), ['required']),
            new ValidationRule('acceptedTos', $person->hasAcceptedTos() ?? null, ['required']),
        );
    }

    public function validate(): void {
        parent::validate();

        $this->validateNutritionTypeManuallyAndNoMacros();
        $this->validateActivityLevelPalLevelAndPalLevelEmpty();
    }

    private function validateNutritionTypeManuallyAndNoMacros(): void {
        if ($this->data->getNutritionType() === NutritionType::MANUALLY->value) {
            $this->validationObject->addError(
                'nutritionType',
                'If you select "Manually", you have to choose your protein, carbohydrates and fat manually.'
            );
        }
    }

    private function validateActivityLevelPalLevelAndPalLevelEmpty(): void {
        if ($this->data->getNutritionType() === ActivityLevel::PAL_LEVEL) {
            $this->validationObject->addError('palLevel', 'If you select "PAL Level", you have to specify the PAL Level below.');
        }
    }

}