<?php

namespace NutriScore\Validators;

class ValidationRule {
    private string $field;
    private mixed $value;
    private array $validations;

    public function __construct(string $field, mixed $value, array $validations = []) {
        $this->field = $field;
        $this->value = $value;
        $this->validations = $validations;
    }

    public function getField(): string {
        return $this->field;
    }

    public function setField(string $field): void {
        $this->field = $field;
    }

    public function getValue(): mixed {
        return $this->value;
    }

    public function setValue(mixed $value): void {
        $this->value = $value;
    }

    public function getValidations(): array {
        return $this->validations;
    }

    public function setValidations(array $validations): void {
        $this->validations = $validations;
    }
}