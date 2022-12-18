<?php
include_once FUNCTIONS_DIRECTORY . 'validations' . DIRECTORY_SEPARATOR . 'BasicErrorMessages.php';
include_once FUNCTIONS_DIRECTORY . 'validations' . DIRECTORY_SEPARATOR . 'basicValidations.php';
include_once FUNCTIONS_DIRECTORY . 'registration' . DIRECTORY_SEPARATOR . 'RegistrationMessages.php';

enum Registration {
    public const USERNAME_FORM_FIELD = 'username';
    public const EMAIL_FORM_FIELD = 'email';
    public const PASSWORD_FORM_FIELD = 'password';
    public const REPEAT_PASSWORD_FORM_FIELD = 'repeatPassword';

    public const FIRST_NAME_FORM_FIELD = 'firstName';
    public const SURNAME_FORM_FIELD = 'surname';
    public const GENDER_FORM_FIELD = 'gender';
    public const GENDER_FORM_FIELD_OPTIONS = ['female', 'male', 'other'];
    public const DATE_OF_BIRTH_FORM_FIELD = 'dateOfBirth';
    public const HEIGHT_FORM_FIELD = 'height';
    public const WEIGHT_FORM_FIELD = 'weight';

    public const NUTRITION_TYPE_FORM_FIELD = 'nutritionType';
    public const NUTRITION_TYPE_FORM_FIELD_OPTIONS = [
        'normal',
        'ketogenic',
        'lowCarb',
        'lowFat',
        'highProtein',
        'manually',
        'dachReference'
    ];

    public const TOS_FORM_FIELD = 'tos';
}

function validateRegistration(): array {
//    Account
    $username = filter_input(INPUT_POST, Registration::USERNAME_FORM_FIELD);
    $email = filter_input(INPUT_POST, Registration::EMAIL_FORM_FIELD);
    $password = filter_input(INPUT_POST, Registration::PASSWORD_FORM_FIELD);
    $repeatPassword = filter_input(INPUT_POST, Registration::REPEAT_PASSWORD_FORM_FIELD);

//    Personal
    $gender = filter_input(INPUT_POST, Registration::GENDER_FORM_FIELD);

//    Nutrition
    $nutritionType = filter_input(INPUT_POST, Registration::NUTRITION_TYPE_FORM_FIELD);

//    Terms of Service
    $tos = filter_input(INPUT_POST, Registration::TOS_FORM_FIELD);

    $errors = [];
    $isValid = true;

    validateUserName($errors, $isValid, $username);
    validateEmail($errors, $isValid, $email);
    validatePassword($errors, $isValid, $password);
    validateRepeatPassword($errors, $isValid, $password, $repeatPassword);
    validateGender($errors, $isValid, $gender);
    validateNutritionType($errors, $isValid, $nutritionType);
    validateTos($errors, $isValid, $tos);

    return [$errors, $isValid];
}

function validateUserName(array &$errors, bool &$isValid, ?string $value): void {
    validateRequired($errors, Registration::USERNAME_FORM_FIELD, $value);
    validateMinLength($errors, Registration::USERNAME_FORM_FIELD, $value, 4);
    validateMaxLength($errors, Registration::USERNAME_FORM_FIELD, $value, 16);
    validateNoWhitespaces($errors, Registration::USERNAME_FORM_FIELD, $value);

    $isValid = $isValid && empty($errors[Registration::USERNAME_FORM_FIELD]);
}

function validateEmail(array &$errors, bool &$isValid, ?string $value): void {
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        $errors[Registration::EMAIL_FORM_FIELD][] = RegistrationMessages::EMAIL_INVALID;
    }

    $isValid = $isValid && empty($errors[Registration::EMAIL_FORM_FIELD]);
}

function validatePassword(array &$errors, bool &$isValid, ?string $value): void {
    validateMinLength($errors, Registration::USERNAME_FORM_FIELD, $value, 8);
    validateNoWhitespaces($errors, Registration::USERNAME_FORM_FIELD, $value);

    if (preg_match( '/[a-z]/', $value ) === 0) {
        $errors[Registration::PASSWORD_FORM_FIELD][] = RegistrationMessages::PASSWORD_AT_LEAST_ONE_LOWERCASE;
    }

    if (preg_match( '/[A-Z]/', $value ) === 0) {
        $errors[Registration::PASSWORD_FORM_FIELD][] = RegistrationMessages::PASSWORD_AT_LEAST_ONE_UPPERCASE;
    }

    if (preg_match( '/\d/', $value ) === 0) {
        $errors[Registration::PASSWORD_FORM_FIELD][] = RegistrationMessages::PASSWORD_AT_LEAST_ONE_NUMBER;
    }

    if (preg_match( '/\W/', $value ) === 0) {
        $errors[Registration::PASSWORD_FORM_FIELD][] = RegistrationMessages::PASSWORD_AT_LEAST_ONE_SPECIAL_CHARACTER;
    }

    $isValid = $isValid && empty($errors[Registration::PASSWORD_FORM_FIELD]);
}

function validateRepeatPassword(array &$errors, bool &$isValid, ?string $password, ?string $repeatPassword): void {
    if ($password !== $repeatPassword) {
        $errors[Registration::REPEAT_PASSWORD_FORM_FIELD][] = RegistrationMessages::REPEAT_PASSWORD_MATCHING_PASSWORD;
    }

    $isValid = $isValid && empty($errors[Registration::REPEAT_PASSWORD_FORM_FIELD]);
}

function validateGender(array &$errors, bool &$isValid, ?string $value): void {
    validateRequired($errors, Registration::GENDER_FORM_FIELD, $value);

    if (!in_array($value, Registration::GENDER_FORM_FIELD_OPTIONS)) {
        $errors[Registration::GENDER_FORM_FIELD][] = RegistrationMessages::SELECTED_GENDER_NOT_IN_AVAILABLE_OPTIONS;
    }

    $isValid = $isValid && empty($errors[Registration::GENDER_FORM_FIELD]);
}

function validateNutritionType(array &$errors, bool &$isValid, ?string $value): void {
    validateRequired($errors, Registration::NUTRITION_TYPE_FORM_FIELD, $value);

    if (!in_array($value, Registration::NUTRITION_TYPE_FORM_FIELD_OPTIONS)) {
        $errors[Registration::NUTRITION_TYPE_FORM_FIELD][] =
            RegistrationMessages::SELECTED_NUTRITION_TYPE_NOT_IN_AVAILABLE_OPTIONS;
    }

    $isValid = $isValid && empty($errors[Registration::NUTRITION_TYPE_FORM_FIELD]);
}

function validateTos(array &$errors, bool &$isValid, ?string $value): void {
    validateRequired($errors, Registration::TOS_FORM_FIELD, $value);

    $isValid = $isValid && empty($errors[Registration::NUTRITION_TYPE_FORM_FIELD]);
}