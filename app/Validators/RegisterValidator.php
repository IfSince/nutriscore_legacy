<?php

namespace NutriScore\Validators;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Models\Person\ActivityLevel;
use NutriScore\Models\Person\NutritionType;

class RegisterValidator extends AbstractValidator {
    private Usermapper $userMapper;

    public function __construct(array $formInput, UserMapper $userMapper) {
        parent::__construct($formInput);

        $this->userMapper = $userMapper;

        $this->addFieldRules(
            new ValidationRule('username', $this->data['username'], ['required', 'minLength' =>  4, 'maxLength' => 16, 'whitespaces']),
            new ValidationRule('email', $this->data['email'], ['required', 'minLength' => 5, 'email']),
            new ValidationRule(
                'password',
                $this->data['password'],
                ['required', 'minLength' => 8, 'matches' => $this->data['repeatPassword'], 'uppercase', 'lowercase', 'number', 'specialchar', 'noWhitespaces']
            ),
            new ValidationRule('repeatPassword', $this->data['repeatPassword'], ['matches' => $this->data['password']]),
            new ValidationRule('acceptedTos', $this->data['acceptedTos'] ?? null, ['required']),
            new ValidationRule('firstName', $this->data['firstName'], ['required', 'minLength'  => 2, 'maxLength' => 100]),
            new ValidationRule('surname', $this->data['surname'], ['required', 'minLength'  => 2, 'maxLength' => 100]),
            new ValidationRule('gender', $this->data['gender']  ?? null, ['required']),
            new ValidationRule('dateOfBirth', $this->data['dateOfBirth'], ['required']),
            new ValidationRule('height', $this->data['height'], ['required']),
            new ValidationRule('weight', $this->data['weight'], ['required']),
            new ValidationRule('nutritionType', $this->data['nutritionType'], ['required']),
            new ValidationRule('bmrCalculationType', $this->data['bmrCalculationType'], ['required']),
            new ValidationRule('activityLevel', $this->data['activityLevel'], ['required']),
            new ValidationRule('goal', $this->data['goal'], ['required']),
        );
    }

    public function validate(): void {
        parent::validate();

        $this->validateUsernameExists();
        $this->validateEmailExists();
        $this->validateNutritionTypeManuallyAndNoMacros();
        $this->validateActivityLevelPalLevelAndPalLevelEmpty();
    }

    private function validateUsernameExists(): void {
        $user = $this->userMapper->findByUsername($this->data['username']);
        if ($user !== null) {
            $this->validationObject->addError('username', 'This username is already taken.');
        }
    }

    private function validateEmailExists(): void {
        $user = $this->userMapper->findByEmail($this->data['email']);
        if ($user !== null) {
            $this->validationObject->addError('email', 'This email is already taken.');
        }
    }

    private function validateNutritionTypeManuallyAndNoMacros(): void {
        if ($this->data['nutritionType'] === NutritionType::MANUALLY->value &&
            (empty($this->data['protein']) ||
             empty($this->data['carbohydrates']) ||
             empty($this->data['fat'])
            )
        ) {
            $this->validationObject->addError(
                'nutritionType',
                'If you select "Manually", you have to choose your protein, carbohydrates and fat manually.'
            );
        }
    }

    private function validateActivityLevelPalLevelAndPalLevelEmpty(): void {
        if ($this->data['activityLevel'] === ActivityLevel::PAL_LEVEL->value && empty($this->data['palLevel'])) {
            $this->validationObject->addError('palLevel', 'If you select "PAL Level", you have to specify the PAL Level below.');
        }
    }


}