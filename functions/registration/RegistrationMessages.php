<?php

enum RegistrationMessages {
//    Email
    public const EMAIL_INVALID = 'Please enter a valid email.';

//    Password
    public const PASSWORD_AT_LEAST_ONE_LOWERCASE = 'The password should contain at least one lowercase character.';
    public const PASSWORD_AT_LEAST_ONE_UPPERCASE = 'The password should contain at least one uppercase character.';
    public const PASSWORD_AT_LEAST_ONE_NUMBER = 'The password should contain at least one number.';
    public const PASSWORD_AT_LEAST_ONE_SPECIAL_CHARACTER = 'The password should contain at least one special character.';

//    Repeat Password
    public const REPEAT_PASSWORD_MATCHING_PASSWORD = 'The repeated password must match the password.';

//    Gender
    public const SELECTED_GENDER_NOT_IN_AVAILABLE_OPTIONS = 'Please select a valid gender.';

//    Nutrition Type
    public const SELECTED_NUTRITION_TYPE_NOT_IN_AVAILABLE_OPTIONS = 'Please select a valid nutrition type.';

//    No Success
    public const ERROR_MESSAGE = 'The registration failed because one or more fields contains errors.';

//    Success
    public const SUCCESS_MESSAGE = 'The registration was successful.';
}