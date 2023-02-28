<?php

namespace NutriScore\Validators;

final class RegisterValidator extends AbstractValidator {
    public function __construct(
        private readonly UserValidator $userValidator,
        private readonly PersonValidator $personValidator,
        private readonly WeightRecordingValidator $weightRecordingValidator,
        private readonly MacroDistributionValidator $macroDistributionValidator,
    ) {
        parent::__construct();
    }

    public function validate(mixed $data): void {
        parent::validate($data);

        $this->userValidator->validate($data['user']);
        $this->personValidator->validate($data['person']);
        $this->weightRecordingValidator->validate($data['weightRecording']);
        $this->macroDistributionValidator->validate($data['macroDistribution']);
    }

    public function setFieldRules(): void {
        $this->addFieldRules(
            new ValidationRule('password', $this->data['user']->getPassword(), [
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
            new ValidationRule('repeatPassword', $this->data['repeatPassword'], ['required', 'matches' => $this->data['user']->getPassword()]),
        );
    }

    public function getValidationObject(): ValidationObject {
        return new ValidationObject(
            errors: [
                ...$this->validationObject->getErrors(),
                ...$this->userValidator->getValidationObject()->getErrors(),
                ...$this->personValidator->getValidationObject()->getErrors(),
                ...$this->weightRecordingValidator->getValidationObject()->getErrors(),
                ...$this->macroDistributionValidator->getValidationObject()->getErrors(),
            ],
            warnings: [
                ...$this->validationObject->getWarnings(),
                ...$this->userValidator->getValidationObject()->getWarnings(),
                ...$this->personValidator->getValidationObject()->getWarnings(),
                ...$this->weightRecordingValidator->getValidationObject()->getWarnings(),
                ...$this->macroDistributionValidator->getValidationObject()->getWarnings(),
            ],
            hints: [
                ...$this->validationObject->getHints(),
                ...$this->userValidator->getValidationObject()->getHints(),
                ...$this->personValidator->getValidationObject()->getHints(),
                ...$this->weightRecordingValidator->getValidationObject()->getHints(),
                ...$this->macroDistributionValidator->getValidationObject()->getHints(),
            ],
            success: [
                ...$this->validationObject->getSuccess(),
                ...$this->userValidator->getValidationObject()->getSuccess(),
                ...$this->personValidator->getValidationObject()->getSuccess(),
                ...$this->weightRecordingValidator->getValidationObject()->getSuccess(),
                ...$this->macroDistributionValidator->getValidationObject()->getSuccess(),
            ],
        );
    }
}