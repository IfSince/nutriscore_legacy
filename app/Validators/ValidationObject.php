<?php

namespace NutriScore\Validators;

class ValidationObject {
    private mixed $data;
    private array $errors;

    public function __construct(mixed $data, array $errors) {
        $this->data = $data;
        $this->errors = $errors;
    }

    public function isValid(): bool {
        return empty($this->errors);
    }

    public function getData(): mixed {
        return $this->data;
    }

    public function setData(mixed $data): void {
        $this->data = $data;
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public function setErrors(array $errors): void {
        $this->errors = $errors;
    }

}