<?php

namespace NutriScore\Utils;

use Exception;

class CSRFToken {
    public const CSRF_TOKEN_KEY = 'csrfToken';

    public static function create(): void {
        $csrfToken = uniqid('', true);
        Session::set(self::CSRF_TOKEN_KEY, $csrfToken);
    }

    public static function get(): string {
        return Session::get(self::CSRF_TOKEN_KEY);
    }

    public static function delete(): void {
        Session::delete(self::CSRF_TOKEN_KEY);
    }

    public static function check(?string $csrfToken): void {
        if ($csrfToken === null || $csrfToken !== CSRFToken::get()) {
            throw new Exception('Your token is invalid.', 403);
        }
    }
}
