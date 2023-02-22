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
use NutriScore\Validators\PersonValidator;
use NutriScore\Validators\RegisterValidator;
use NutriScore\Validators\UserValidator;
use NutriScore\Validators\ValidationObject;

class RegisterService {
    private UserMapper $userMapper;
    private PersonMapper $personMapper;
    private WeightRecordingMapper $weightRecordingMapper;
    private MacroDistributionMapper $macroDistributionMapper;

    public function __construct() {
        $this->userMapper = new UserMapper();
        $this->personMapper = new PersonMapper();
        $this->weightRecordingMapper = new WeightRecordingMapper();
        $this->macroDistributionMapper = new MacroDistributionMapper();
    }

    // unsauber, da doppelt validiert wird. Allerdings notwendig, da beim Speichern selber noch Fehler auftreten können.
    // TODO: In der DB mit Transactions arbeiten, damit angelegte Entitäten bei Fehler wieder Rollbacked werden können.
    // Dann muss nicht separat vorher validiert werden, sondern es kann direkt auf die save Methoden im jeweiligen Service zugegriffen werden.
    public function register(array $data): ValidationObject {
        $user = User::create($data);
        $person = Person::create($data);
        $weightRecording = WeightRecording::create($data);
        $macroDistribution = MacroDistribution::create($data);

        $registerValidator = new RegisterValidator($data);
        $registerValidator->validate();

        $userValidator = new UserValidator($user);
        $userValidator->validate();

        $personValidator = new PersonValidator($person);
        $personValidator->validate();

        if (
            $registerValidator->isValid() &&
            $userValidator->isValid() &&
            $personValidator->isValid()
        ) {
            $this->userMapper->save($user);

            $person->setUserId($user->getId());
            $this->personMapper->save($person);

            $weightRecording->setUserId($user->getId());
            $this->weightRecordingMapper->save($weightRecording);

            if ($person->getNutritionType()->getMacroDistribution() === null) {
                $macroDistribution->setUserId($user->getId());
                $this->macroDistributionMapper->save($macroDistribution);
            }
        }

        return new ValidationObject(
            errors: [
                ...$registerValidator->getValidationObject()->getErrors(),
                ...$userValidator->getValidationObject()->getErrors(),
                ...$personValidator->getValidationObject()->getErrors()
            ],
            warnings: [
                ...$registerValidator->getValidationObject()->getWarnings(),
                ...$userValidator->getValidationObject()->getWarnings(),
                ...$personValidator->getValidationObject()->getWarnings()
            ],
            hints: [
                ...$registerValidator->getValidationObject()->getHints(),
                ...$userValidator->getValidationObject()->getHints(),
                ...$personValidator->getValidationObject()->getHints()
            ],
            success: [
                ...$registerValidator->getValidationObject()->getSuccess(),
                ...$userValidator->getValidationObject()->getSuccess(),
                ...$personValidator->getValidationObject()->getSuccess()
            ],
        );
    }
}