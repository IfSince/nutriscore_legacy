<?php

namespace NutriScore\Validators;

class MacroDistributionValidator extends AbstractValidator {

    public function validate(mixed $data): void {
        parent::validate($data);

        $this->validateMacroDistributionsNot100();
    }

    private function validateMacroDistributionsNot100(): void {
        $sum = $this->data->getProtein() + $this->data->getCarbohydrates() + $this->data->getFat();
        if ($sum !== 100) {
            $this->validationObject->addError('protein', _('The macro nutrient distribution must equal 100%.'));
        }
    }
}