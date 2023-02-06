<?php

namespace NutriScore\Validators;

use NutriScore\DataMappers\UserMapper;

class RegisterFormValidator extends FormValidator {
    private UserMapper $userMapper;

    public function __construct(array $formInput, $userMapper) {
        parent::__construct($formInput);
        $this->userMapper = $userMapper;
        $this->setRules([
            'username' => 'required|min:4|max:16|whitespaces',
            'email' => 'required|min:3|email',
            'password' => 'required|min:8|matches:repeatPassword|uppercase|lowercase|number|specialchar|noWhitespaces',
            'repeatPassword' => 'matches:password',
            'acceptedTos' => 'required',
            'firstName' => 'required|min:2|max:100',
            'surname' => 'required|min:2|max:100',
            'gender' => 'required',
            'dateOfBirth' => 'required',
            'height' => 'required',
            'startingWeight' => 'required',
            'nutritionType' => 'required',
            'bmrCalculationType' => 'required',
            'activityLevel' => 'required',
            'goal' => 'required',
        ]);
    }

    public function validate(): void {
        parent::validate();

        $this->validateUsernameExists($this->formInput['username']);
        $this->validateEmailExists($this->formInput['email']);
        $this->validateNutritionTypeManually($this->formInput['nutritionType']);
        $this->validateActivityLevel($this->formInput['activityLevel']);
    }

    private function validateUsernameExists(string $username): void {
        if ($this->userMapper->findByUsername($username) != null) {
            $this->errors['username'][] = 'This username is already taken.';
        }
    }

    private function validateEmailExists(string $email): void {
        if ($this->userMapper->findByEmail($email) != null) {
            $this->errors['email'][] = 'This email is already taken.';
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