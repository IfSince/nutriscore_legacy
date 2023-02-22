<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\MacroDistributionMapper;
use NutriScore\DataMappers\PersonMapper;
use NutriScore\DataMappers\UserMapper;
use NutriScore\DataMappers\WeightRecordingMapper;
use NutriScore\Models\MacroDistribution\MacroDistribution;
use NutriScore\Models\Person\Person;
use NutriScore\Models\User\User;
use NutriScore\Models\WeightRecording\WeightRecording;
use NutriScore\Validators\ValidationObject;

class RegisterService {

    public function __construct(
        private readonly UserMapper              $userMapper,
        private readonly PersonMapper            $personMapper,
        private readonly WeightRecordingMapper   $weightRecordingMapper,
        private readonly MacroDistributionMapper $macroDistributionMapper,
    ) {
    }

    // TODO Redo when Transaction Handling in DB is there
    public function register(array $data): ValidationObject {
        $user = User::create($data);
        $person = Person::create($data);
        $weightRecording = WeightRecording::create($data);
        $macroDistribution = MacroDistribution::create($data);
//
//        $registerValidator = new RegisterValidator($data);
//        $registerValidator->validate();
//
//        $userValidator = new UserValidator($user);
//        $userValidator->validate();
//
//        $personValidator = new PersonValidator($person);
//        $personValidator->validate();
//
//        if (
//            $registerValidator->isValid() &&
//            $userValidator->isValid() &&
//            $personValidator->isValid()
//        ) {
//            $this->userMapper->save($user);
//
//            $person->setUserId($user->getId());
//            $this->personMapper->save($person);
//
//            $weightRecording->setUserId($user->getId());
//            $this->weightRecordingMapper->save($weightRecording);
//
//            if ($person->getNutritionType()->getMacroDistribution() === null) {
//                $macroDistribution->setUserId($user->getId());
//                $this->macroDistributionMapper->save($macroDistribution);
//            }
//        }

        return new ValidationObject(
//            errors: [
//                ...$registerValidator->getValidationObject()->getErrors(),
//                ...$userValidator->getValidationObject()->getErrors(),
//                ...$personValidator->getValidationObject()->getErrors()
//            ],
//            warnings: [
//                ...$registerValidator->getValidationObject()->getWarnings(),
//                ...$userValidator->getValidationObject()->getWarnings(),
//                ...$personValidator->getValidationObject()->getWarnings()
//            ],
//            hints: [
//                ...$registerValidator->getValidationObject()->getHints(),
//                ...$userValidator->getValidationObject()->getHints(),
//                ...$personValidator->getValidationObject()->getHints()
//            ],
//            success: [
//                ...$registerValidator->getValidationObject()->getSuccess(),
//                ...$userValidator->getValidationObject()->getSuccess(),
//                ...$personValidator->getValidationObject()->getSuccess()
//            ],
        );
    }
}