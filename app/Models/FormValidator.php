<?php

class FormValidator {
    protected array $formInput;
    private array $rules = [];
    protected array $errors = [];

    public function __construct(array $formInput) {
        $this->formInput = $formInput;
    }

    public function setRules(array $rules): void {
        $this->rules = $rules;
    }

    public function validate(): void {
        foreach ($this->rules as $field => $fieldRules) {
            $fieldRules = explode('|', $fieldRules);

            $this->validateField($field, $fieldRules);
        }
    }

    public function isValid(): bool {
        return empty($this->errors);
    }

    public function getErrors(): array {
        return $this->errors;
    }

    protected function validateField(string $field, array $fieldRules): void {
        foreach ($fieldRules as $fieldRule) {
            $ruleSegments = explode(':', $fieldRule);
            $fieldRule = $ruleSegments[0];
            $satisfier = $ruleSegments[1] ?? null;

            $this->validateFieldRule($field, $fieldRule, $satisfier);
        }
    }

    protected function validateFieldRule(string $field, string $fieldRule, ?string $satisfier): void {
        if (method_exists(self::class, $fieldRule)) {
            $this->{$fieldRule}($field, $satisfier);
        }
    }

    protected function required(string $field): void {
        $var = $this->formInput[$field] ?? null;
        if (empty($var)) {
            $this->errors[$field][] = "This field is required.";
        }
    }

    protected function min(string $field, string $satisfier): void {
        $var = $this->formInput[$field] ?? null;
        if (strlen($var) < (int)$satisfier) {
            $this->errors[$field][] = "Must be at least $satisfier characters.";
        }
    }

    protected function max(string $field, string $satisfier): void {
        if (strlen($this->formInput[$field]) > (int)$satisfier) {
            $this->errors[$field][] = "Must be more than $satisfier characters.";
        }
    }

    protected function uppercase(string $field): void {
        if (!preg_match("/[A-Z]/", $this->formInput[$field])) {
            $this->errors[$field][] = "This field requires at least one uppercase letter.";
        }
    }

    protected function lowercase(string $field): void {
        if (!preg_match("/[a-z]/", $this->formInput[$field])) {
            $this->errors[$field][] = "This field requires at least one lowercase letter.";
        }
    }

    protected function number(string $field): void {
        if (!preg_match("/\d/", $this->formInput[$field])) {
            $this->errors[$field][] = "This field requires at least one number.";
        }
    }

    protected function specialchar(string $field): void {
        if (!preg_match('/^[a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]*$/', $this->formInput[$field])) {
            $this->errors[$field][] = "This field requires at least one special character.";
        }
    }

    protected function noWhitespaces(string $field): void {
        if (preg_match("/\s/", $this->formInput[$field])) {
            $this->errors[$field][] = "This field must not contain any whitespaces.";
        }
    }

    protected function email(string $field): void {
        if (!filter_var($this->formInput[$field], FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "This field must be a valid email address.";
        }
    }

    protected function matches(string $field, string $satisfier): void {
        if ($this->formInput[$field] !== $this->formInput[$satisfier]) {
            $this->errors[$field][] = "This field must match the $satisfier.";
        }
    }
}
