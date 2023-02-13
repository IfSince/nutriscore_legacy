<?php

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

function renderValidationFieldErrors(string $fieldName, ?array $validationFields = null): void {
    if ($validationFields != null) {
        $temp = array_filter($validationFields, fn(ValidationField $field) => $field->getField() === $fieldName);
        $temp = array_map(fn(ValidationField $field) => $field->getMessage(), $temp);

        foreach ($temp as $message) {
            echo "<li>$message</li>";
        }
    }
}