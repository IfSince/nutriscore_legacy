<?php

namespace NutriScore\Validators;

class ValidationObject {
    private mixed $data;
    private array $errors;
    private array $warnings;
    private array $hints;
    private array $success;

    public function __construct(mixed $data = null, array $errors = [], array $warnings = [], array $hints = [], array $success = []) {
        $this->data = $data;
        $this->errors = $errors;
        $this->warnings = $warnings;
        $this->hints = $hints;
        $this->success = $success;
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

    public function getWarnings(): array {
        return $this->warnings;
    }

    public function getHints(): array {
        return $this->hints;
    }

    public function getSuccess(): array {
        return $this->success;
    }

    public function addError(string $field, string $message): void {
        $this->errors[] = new ValidationField($field, $message);
    }

    public function renderMessages(): array {
        return [
            'errors' => $this->getErrors(),
            'warnings' => $this->getWarnings(),
            'hints' => $this->getHints(),
            'success' => $this->getSuccess()
        ];
    }

}