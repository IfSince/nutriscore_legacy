<?php

require_once 'FormValidator.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Database.php';

class RegisterFormValidator extends FormValidator {
    private User $user;

    public function __construct(array $formInput) {
        parent::__construct($formInput);

        $this->user = new User();
    }

    protected function validateFieldRule(string $field, string $fieldRule, ?string $satisfier): void {
        if (method_exists(self::class, $fieldRule) ||
            method_exists(get_parent_class(self::class), $fieldRule)
        ) {
            $this->{$fieldRule}($field, $satisfier);
        }
    }

    protected function exists(string $field): void {
        $usernameTaken = $this->user->usernameAlreadyTaken($this->formInput[$field]);

        if ($usernameTaken) {
            $this->errors[$field][] = "This username is already taken";
        }
    }

}