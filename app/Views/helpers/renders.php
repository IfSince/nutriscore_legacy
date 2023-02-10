<?php
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