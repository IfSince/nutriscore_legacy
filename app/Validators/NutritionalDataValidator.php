<?php

namespace NutriScore\Validators;

class NutritionalDataValidator extends AbstractValidator {
    public function __construct(
        private readonly PersonValidator $personValidator,
        private readonly MacroDistributionValidator $macroDistributionValidator,
    ) {
        parent::__construct();
    }

    public function validate(mixed $data): void {
        parent::validate($data);

        $this->personValidator->validate($data['person']);
        $this->macroDistributionValidator->validate($data['macroDistribution']);
    }

    public function getValidationObject(): ValidationObject {
        return new ValidationObject(
            errors: [
                ...$this->validationObject->getErrors(),
                ...$this->personValidator->getValidationObject()->getErrors(),
                ...$this->macroDistributionValidator->getValidationObject()->getErrors(),
            ],
            warnings: [
                ...$this->validationObject->getWarnings(),
                ...$this->personValidator->getValidationObject()->getWarnings(),
                ...$this->macroDistributionValidator->getValidationObject()->getWarnings(),
            ],
            hints: [
                ...$this->validationObject->getHints(),
                ...$this->personValidator->getValidationObject()->getHints(),
                ...$this->macroDistributionValidator->getValidationObject()->getHints(),
            ],
            success: [
                ...$this->validationObject->getSuccess(),
                ...$this->personValidator->getValidationObject()->getSuccess(),
                ...$this->macroDistributionValidator->getValidationObject()->getSuccess(),
            ],
        );
    }
}