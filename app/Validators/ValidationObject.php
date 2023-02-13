<?php

namespace NutriScore\Validators;

use NutriScore\Enums\MessageType;

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

    public function addMessage(string $field, string $message = "", MessageType $type = MessageType::ERROR): void {
        match ($type) {
            MessageType::ERROR => $this->errors[] = new ValidationField($field, $message),
            MessageType::WARNING => $this->warnings[] = new ValidationField($field, $message),
            MessageType::HINT => $this->hints[] = new ValidationField($field, $message),
            MessageType::SUCCESS => $this->success[] = new ValidationField($field, $message),
        };
    }

}