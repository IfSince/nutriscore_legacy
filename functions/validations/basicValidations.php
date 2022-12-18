<?php
function validateRequired(array &$errors, string $field, mixed $value): void {
    if (empty($value)) {
        $errors[$field][] = ErrorMessages::FIELD_REQUIRED;
    }
}

function validateMinLength(array &$errors, string $field, mixed $value, int $minLength): void {
    if (strlen($value) < $minLength) {
        $errors[$field][] = parseMessageWithParams(
            ErrorMessages::FIELD_MINLENGTH,
            ['{minLength}' => $minLength]
        );
    }
}

function validateMaxLength(array &$errors, string $field, mixed $value, int $maxLength): void {
    if (strlen($value) > $maxLength) {
        $errors[$field][] = parseMessageWithParams(
            ErrorMessages::FIELD_MAXLENGTH,
            ['{maxLength}' => $maxLength]
        );
    }
}

function validateNoWhitespaces(array &$errors, string $field, mixed $value): void {
    if (preg_match("/\s/", $value)) {
        $errors[Registration::USERNAME_FORM_FIELD][] = ErrorMessages::FIELD_NO_WHITESPACES;
    }
}