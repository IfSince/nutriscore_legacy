<?php

namespace NutriScore\Utils;

class StringUtil {
    public static function kebabToCamelCase(string &$string, bool $capitalizeFirstCharacter = false): string {
        $string = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));

        if (!$capitalizeFirstCharacter) {
            return lcfirst($string);
        }

        return $string;
    }
}