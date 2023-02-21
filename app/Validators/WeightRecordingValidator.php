<?php

namespace NutriScore\Validators;

use NutriScore\Models\WeightRecording\WeightRecording;

class WeightRecordingValidator extends AbstractValidator {
    public function __construct(WeightRecording $weightRecording) {
        parent::__construct($weightRecording);

        $this->addFieldRules(
            new ValidationRule('weight', $weightRecording->getWeight(), ['required']),
            new ValidationRule('dateOfRecording', $weightRecording->getDateOfRecording(), ['required'])
        );
    }

    public function validate(): void {
        parent::validate();

        $this->validateNegativeWeight();
    }

    private function validateNegativeWeight(): void {
        if ($this->data->getWeight() < 0) {
            $this->validationObject->addError('weight', _('Please enter a valid weight'));
        }
    }
}