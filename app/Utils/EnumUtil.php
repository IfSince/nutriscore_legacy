<?php

namespace NutriScore\Utils;

enum EnumUtil {
    public static function mapEnumValue(mixed $enumClass, mixed $value): mixed {
        if ($value) {
            return (gettype($value) === 'string' || gettype($value) === 'integer') ? $enumClass::from($value) : $value;
        } else {
            return null;
        }
    }
}
