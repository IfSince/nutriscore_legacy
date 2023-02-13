<?php

namespace NutriScore\Validators;

class ValidationField {
    public function __construct(
        private string $field,
        private string $message
    ) {
    }
    public function getField(): string {
        return $this->field;
    }

    public function setField(string $field): void {
        $this->field = $field;
    }

    public function getMessage(): string {
        return $this->message;
    }

    public function setMessage(string $message): void {
        $this->message = $message;
    }
}