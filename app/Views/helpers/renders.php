<?php

use NutriScore\Enums\MessageType;
use NutriScore\Validators\ValidationField;

function getTemplatePart(string $name, ?array $data = []): void {
    extract($data);
    require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR ."$name.php";
}

function renderValue(string $fieldName): void {
    $value = filter_input(INPUT_POST, $fieldName) ?? null;
    echo "value=\"$value\"";
}

function renderChecked(string $fieldName): void {
    $value = filter_input(INPUT_POST, $fieldName);

    if (isset($value)) {
        echo 'checked';
    }
}

function renderCheckedByValue(string $fieldName, $expectedValue): void {
    $value = filter_input(INPUT_POST, $fieldName);

    if ($value == $expectedValue) {
        echo 'checked';
    }
}

function renderSelectedByValue(string $fieldName, $expectedValue): void {
    $value = filter_input(INPUT_POST, $fieldName);

    if ($value == $expectedValue) {
        echo 'selected';
    }
}

function renderFieldErrors(?array $errors, string $fieldName): void {
    if (isset($errors[$fieldName])) {
        foreach ($errors[$fieldName] as $error) {
            echo "<li>$error</li>";
        }
    }
}

function getValidationFieldMessages(string $fieldName, ?array $messages = null): array {
    if (isset($messages)) {
        return array_merge(
            array_filter($messages['errors'] ?? [], fn(ValidationField $field) => $field->getField() === $fieldName),
            array_filter($messages['warnings'] ?? [], fn(ValidationField $field) => $field->getField() === $fieldName),
            array_filter($messages['hints'] ?? [], fn(ValidationField $field) => $field->getField() === $fieldName),
            array_filter($messages['success'] ?? [], fn(ValidationField $field) => $field->getField() === $fieldName),
        );
    } else {
        return [];
    }
}

function renderValidationFieldMessages(string $fieldName, ?array $messages = null): void {
    if (isset($messages)) {
        $fieldMessages = getValidationFieldMessages($fieldName, $messages);

        foreach ($fieldMessages as $fieldMessage) {
            $message = $fieldMessage->getMessage();
            echo "<li>$message</li>";
        }
    }
}

function getValidationFieldMessagesByType(string $fieldName, ?array $messages = [], MessageType $type): array {
    if (isset($messages)) {
        return match ($type) {
            MessageType::ERROR => array_filter($messages['errors'] ?? [], fn(ValidationField $field) => $field->getField() === $fieldName),
            MessageType::WARNING => array_filter($messages['warnings'] ?? [], fn(ValidationField $field) => $field->getField() === $fieldName),
            MessageType::HINT => array_filter($messages['hints'] ?? [], fn(ValidationField $field) => $field->getField() === $fieldName),
            MessageType::SUCCESS => array_filter($messages['success'] ?? [], fn(ValidationField $field) => $field->getField() === $fieldName)
        };
    } else {
        return [];
    }
}