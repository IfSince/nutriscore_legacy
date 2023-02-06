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

    /**
     * @return mixed
     */
    public function getData(): mixed {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData(mixed $data): void {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getErrors(): array {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors): void {
        $this->errors = $errors;
    }

}