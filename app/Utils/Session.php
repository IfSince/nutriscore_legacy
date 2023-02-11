<?php

namespace NutriScore\Utils;

use NutriScore\Enums\MessageType;

class Session {
    private static string $FLASH_PREFIX = "flash-";
    public static function exists(string $key): bool {
        return isset($_SESSION[$key]);
    }

    public static function anyExists(string $key): bool {
        foreach($_SESSION as $sessionKey => $sessionValue) {
            if (str_starts_with($sessionKey, $key)) {
                return true;
            }
        }
        return false;
    }

    public static function get(string $key): mixed {
        if (self::exists($key)) {
            return $_SESSION[$key];
        } else {
            return null;
        }
    }

    public static function set(string $key, mixed $value): void {
        $_SESSION[$key] = $value;
    }

    public static function delete(string $key): void {
        unset($_SESSION[$key]);
    }

    public static function flash(
        string      $key = '',
        string      $message = null,
        MessageType $messageType = MessageType::HINT
    ): ?string {
        $key = self::$FLASH_PREFIX . "$messageType->value-$key";

        if (self::exists($key)) {
            $message = self::get($key);
            self::delete($key);

            return $message;
        } else {
            self::set($key, $message);
            return null;
        }
    }

    public static function hasFlashMessages(): bool {
        return self::anyExists('flash-');
    }

    public static function getFlashMessagesByType(MessageType $messageType): array {
        $key = self::$FLASH_PREFIX . $messageType->value;
        $result = [];
        foreach ($_SESSION as $sessionKey => $sessionValue) {
            if (str_starts_with($sessionKey, $key)) {
                $result[$sessionKey] = self::flash(
                    key: str_replace("$key-", '', $sessionKey),
                    messageType: $messageType
                );
            }
        }
        return $result;
    }
}