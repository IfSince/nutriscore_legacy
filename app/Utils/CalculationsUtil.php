<?php

namespace NutriScore\Utils;

class CalculationsUtil {
    public static function percentage(int $value, int $percentage): int {
        return $value * ($percentage / 100);
    }
}