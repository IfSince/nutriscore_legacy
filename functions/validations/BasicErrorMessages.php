<?php
enum ErrorMessages {
    public const FIELD_REQUIRED = 'This field is required.';
    public const FIELD_MINLENGTH = 'This field must contain at least {minLength} characters.';
    public const FIELD_MAXLENGTH = 'This field must contain a maximum of {maxLength} characters.';
    public const FIELD_NO_WHITESPACES = 'This field must not contain any whitespaces.';
}

function parseMessageWithParams(string $string, array $params): string {
    return strtr($string, $params);
}