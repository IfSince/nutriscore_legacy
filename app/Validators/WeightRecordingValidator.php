<?php

namespace NutriScore\Validators;

class WeightRecordingValidator extends AbstractValidator {
    public function validate(mixed $data): void {
        parent::validate($data);

        $this->validateNegativeWeight();
    }

    protected function setFieldRules(): void {
        $this->addFieldRules(
            new ValidationRule('weight', $this->data->getWeight(), ['required']),
            new ValidationRule('dateOfRecording', $this->data->getDateOfRecording(), ['required'])
        );
    }

    private function validateNegativeWeight(): void {
        if ($this->data->getWeight() < 0) {
            $this->validationObject->addError('weight', _('Please enter a valid weight'));
        }
    }
}