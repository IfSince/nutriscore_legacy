<?php

namespace NutriScore\Utils;

class ArrayUtil {
    public static function snakeCaseToCamelCaseKeys(array $array): array {
        $keys = array_map(function ($key) {
            return preg_replace_callback('/_([a-z])/', function ($match) {
                return strtoupper($match[1]);
            }, $key);
        }, array_keys($array));

        return array_combine($keys, array_values($array));
    }
}