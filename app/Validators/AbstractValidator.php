<?php

namespace NutriScore\Validators;

class AbstractValidator {
    protected mixed $data;

    /**
     * @var array<ValidationRule>
     */
    private array $fieldRules = [];

    protected ValidationObject $validationObject;

    public function __construct(mixed $data) {
        $this->validationObject = new ValidationObject();
        $this->validationObject->setData($data);
        $this->data = $data;
    }

    public function getValidationObject(): ValidationObject {
        return $this->validationObject;
    }

    protected function addFieldRules(ValidationRule ...$rules): void {
        array_push($this->fieldRules, ...$rules);
    }

    public function isValid(): bool {
        return $this->validationObject->isValid();
    }

    protected function validate(): void {
        foreach ($this->fieldRules as $fieldRule) {
            $this->validateField($fieldRule);
        }
    }

    protected function validateField(ValidationRule $validationRule): void {
        foreach ($validationRule->getValidations() as $validation => $params) {
            // when no params are set, the validation name is instead set to params, which is why we need to set manually
            if (gettype($validation) === 'integer') {
                $validation = $params;
                $params = null;
            }

            if (method_exists(self::class, $validation)) {
                $this->{$validation}($validationRule->getValue(), $validationRule->getField(), $params);
            }
        }
    }

    protected function required(mixed $value, string $field): void {
        if (empty($value)) {
            $this->validationObject->addMessage($field, "This field is required.");
        }
    }

    protected function minLength(mixed $value, string $field, int $minLength): void {
        if (strlen($value) < $minLength) {
            $this->validationObject->addMessage($field, "Must be at least $minLength characters.");
        }
    }
}