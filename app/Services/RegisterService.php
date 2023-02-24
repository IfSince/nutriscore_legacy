<?php

namespace NutriScore\Services;

use Exception;
use NutriScore\Models\MacroDistribution\MacroDistribution;
use NutriScore\Models\Person\Person;
use NutriScore\Models\User\User;
use NutriScore\Models\WeightRecording\WeightRecording;
use NutriScore\Validators\ValidationObject;

class RegisterService {

    public function __construct(
        private readonly UserService              $userService,
        private readonly PersonService            $personService,
        private readonly WeightRecordingService   $weightRecordingService,
        private readonly MacroDistributionService $macroDistributionService,
    ) {
    }

    public function register(array $data): ValidationObject {
        $user = User::create($data);
        $person = Person::create($data);
        $weightRecording = WeightRecording::create($data);
        $macroDistribution = MacroDistribution::create($data);

        $userValidation = $this->userService->save($user);

        if ($userValidation->isValid()) {
            $person->setUserId($user->getId());
            $personValidation = $this->personService->save($person);

            $weightRecording->setUserId($user->getId());
            $weightRecordingValidation = $this->weightRecordingService->saveWithImage($weightRecording);

            if ($person->getNutritionType()->getMacroDistribution() === null) {
                $macroDistribution->setUserId($user->getId());
                $macroDistributionValidation = $this->macroDistributionService->save($macroDistribution);
            }
        }
        return new ValidationObject(
            errors: [
                ...$userValidation->getErrors(),
                ...isset($personValidation) ? $personValidation->getErrors() : [],
                ...isset($weightRecordingValidation) ? $weightRecordingValidation->getErrors() : [],
                ...isset($macroDistributionValidation) ? $macroDistributionValidation->getErrors() : [],
            ],
            warnings: [
                ...$userValidation->getWarnings(),
                ...isset($personValidation) ? $personValidation->getWarnings() : [],
                ...isset($weightRecordingValidation) ? $weightRecordingValidation->getWarnings() : [],
                ...isset($macroDistributionValidation) ? $macroDistributionValidation->getWarnings() : [],
            ],
            hints: [
                ...$userValidation->getHints(),
                ...isset($personValidation) ? $personValidation->getHints() : [],
                ...isset($weightRecordingValidation) ? $weightRecordingValidation->getHints() : [],
                ...isset($macroDistributionValidation) ? $macroDistributionValidation->getHints() : [],
            ],
            success: [
                ...$userValidation->getSuccess(),
                ...isset($personValidation) ? $personValidation->getSuccess() : [],
                ...isset($weightRecordingValidation) ? $weightRecordingValidation->getSuccess() : [],
                ...isset($macroDistributionValidation) ? $macroDistributionValidation->getSuccess() : [],
            ],
        );
    }
}