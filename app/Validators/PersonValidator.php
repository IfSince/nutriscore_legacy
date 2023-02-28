<?php

namespace NutriScore\Validators;

use NutriScore\Models\Person\ActivityLevel;
use NutriScore\Models\Person\NutritionType;

final class PersonValidator extends AbstractValidator {
    public function validate(mixed $data): void {
        parent::validate($data);

        $this->validateNutritionTypeManuallyAndNoMacros();
        $this->validateActivityLevelPalLevelAndPalLevelEmpty();
    }

    protected function setFieldRules(): void {
        $this->addFieldRules(
            new ValidationRule('firstName', $this->data->getFirstName(), ['required', 'minLength'  => 2, 'maxLength' => 100]),
            new ValidationRule('surname', $this->data->getSurname(), ['required', 'minLength'  => 2, 'maxLength' => 100]),
            new ValidationRule('gender', $this->data->getGender() ?? null, ['required']),
            new ValidationRule('dateOfBirth', $this->data->getDateOfBirth(), ['required']),
            new ValidationRule('height', $this->data->getHeight(), ['required']),
            new ValidationRule('nutritionType', $this->data->getNutritionType(), ['required']),
            new ValidationRule('bmrCalculationType', $this->data->getBmrCalculationType(), ['required']),
            new ValidationRule('activityLevel', $this->data->getActivityLevel(), ['required']),
            new ValidationRule('goal', $this->data->getGoal(), ['required']),
            new ValidationRule('acceptedTos', $this->data->hasAcceptedTos() ?? null, ['required']),
        );
    }

    private function validateNutritionTypeManuallyAndNoMacros(): void {
        if ($this->data->getNutritionType() === NutritionType::MANUALLY && 1 == 2) {
            $this->validationObject->addError(
                'nutritionType',
                _('If you select "Manually", you have to choose your protein, carbohydrates and fat manually.')
            );
        }
    }

    private function validateActivityLevelPalLevelAndPalLevelEmpty(): void {
        if ($this->data->getActivityLevel() === ActivityLevel::PAL_LEVEL && $this->data->getPalLevel() === null) {
            $this->validationObject->addError('activityLevel', _('If you select "PAL Level", you have to specify the PAL Level.'));
        }
    }
}