<?php

namespace NutriScore\Validators;

use NutriScore\DataMappers\UserMapper;

class RegisterFormValidator extends FormValidator {
    private UserMapper $userMapper;

    public function __construct(array $formInput, $userMapper) {
        parent::__construct($formInput);
        $this->userMapper = $userMapper;
    }

    public function validate(): void {
        parent::validate();

        $this->validateUsernameExists($this->formInput['username']);
        $this->validateNutritionTypeManually($this->formInput['nutritionType']);
        $this->validateActivityLevel($this->formInput['activityLevel']);
    }

    private function validateUsernameExists(string $username): void {
        if ($this->userMapper->findByUsername($username) != null) {
            $this->errors['username'][] = 'This username is already taken.';
        }
    }

    private function validateNutritionTypeManually(string $nutritionType): void {
        if ($nutritionType === 'manually' &&
            (empty($this->formInput['protein']) ||
                empty($this->formInput['carbohydrates']) ||
                empty($this->formInput['fat'])
            )
        ) {
            $this->errors['nutritionType'][] = 'If you select "Manually", you have to choose your protein, carbohydrates and fat manually.';
        }
    }

    private function validateActivityLevel(string $activityLevel): void {
        if ($activityLevel === 'palLevel' && empty($this->formInput['palLevel'])) {
            $this->errors['activityLevel'][] = 'If you select "PAL Level", you have to specify the PAL Level below.';
        }
    }

}