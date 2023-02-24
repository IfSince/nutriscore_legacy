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
use NutriScore\Validators\RegisterValidator;
use NutriScore\Validators\ValidationObject;

class RegisterService {

    public function __construct(
        private readonly RegisterValidator       $validator,
        private readonly UserMapper              $userMapper,
        private readonly PersonMapper            $personMapper,
        private readonly WeightRecordingMapper   $weightRecordingMapper,
        private readonly MacroDistributionMapper $macroDistributionMapper,
    ) { }

    public function register(array $data): ValidationObject {
        $user = User::create($data);
        $person = Person::create($data);
        $weightRecording = WeightRecording::create($data);
        $macroDistribution = $person->getNutritionType()->getMacroDistribution() ?? MacroDistribution::create($data);

        $data = [
            'user' => $user,
            'person' => $person,
            'weightRecording' => $weightRecording,
            'macroDistribution' => $macroDistribution,
            'repeatPassword' => $data['repeatPassword']
        ];

        $this->validator->validate($data);

        if ($this->validator->isValid()) {
            $this->userMapper->save($user);

            $person->setUserId($user->getId());
            $this->personMapper->save($person);

            $weightRecording->setUserId($user->getId());
            $this->weightRecordingMapper->save($weightRecording);

            // if no mapping exists, the macro distribution has to be saved manually
            if ($person->getNutritionType()->getMacroDistribution() === null) {
                $macroDistribution->setUserId($user->getId());
                $this->macroDistributionMapper->save($macroDistribution);
            }
        }
        return $this->validator->getValidationObject();
    }
}