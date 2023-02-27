<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\MacroDistributionMapper;
use NutriScore\DataMappers\PersonMapper;
use NutriScore\DataMappers\WeightRecordingMapper;
use NutriScore\Models\Person\PersonDTO;

class PersonDTOCreateService {
    public function __construct(
        private readonly PersonMapper $personMapper,
        private readonly MacroDistributionMapper $macroDistributionMapper,
        private readonly WeightRecordingMapper $weightRecordingMapper,
        private readonly PersonCalculationService $personCalculationService,
    ) {
    }

    public function createPersonDTOByUserId(int $userId): PersonDTO {
        $person = $this->personMapper->findByUserId($userId);
        $macroDistribution =
            $person->getNutritionType()->getMacroDistribution()
            ??
            $this->macroDistributionMapper->findByUserId($userId);
        $weightRecording = $this->weightRecordingMapper->findLatestByUserId($userId);

        $bodyMassIndex =
            $this->personCalculationService->getBodyMassIndex($person->getHeight(), $weightRecording->getWeight());

        $restingMetabolicRate = $this->personCalculationService->getRestingMetabolicRate(
            $person->getBmrCalculationType(),
            $person->getGender(),
            $weightRecording->getWeight(),
            $person->getHeight(),
            $person->getAge(),
        );
        $basalMetabolicRate = $this->personCalculationService->getBasalMetabolicRate(
            $restingMetabolicRate,
            $person->getActivityLevel(),
            $person->getPalLevel()
        );

        $calorieIntake = $this->personCalculationService->getCalorieIntake($basalMetabolicRate, $person->getGoal());
        $proteinIntake = $this->personCalculationService->getProteinIntake(
            $calorieIntake,
            $macroDistribution->getProtein(),
            $person->getNutritionType(),
            $weightRecording->getWeight(),
            $person->getAge(),
            $person->getGender(),
        );
        $carbohydratesIntake = $this->personCalculationService->getCarbohydratesIntake(
            $calorieIntake,
            $macroDistribution->getCarbohydrates()
        );
        $fatIntake = $this->personCalculationService->getFatIntake($calorieIntake, $macroDistribution->getFat());

        return new PersonDTO(
            macroDistribution: $macroDistribution,
            weight: $weightRecording->getWeight(),
            height: $person->getHeight(),
            age: $person->getAge(),
            bodyMassIndex: $bodyMassIndex,
            restingMetabolicRate: $restingMetabolicRate,
            basalMetabolicRate: $basalMetabolicRate,
            calorieIntake: $calorieIntake,
            proteinIntake: $proteinIntake,
            carbohydratesIntake: $carbohydratesIntake,
            fatIntake: $fatIntake,
        );
    }
}