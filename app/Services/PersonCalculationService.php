<?php

namespace NutriScore\Services;

use NutriScore\Models\Person\ActivityLevel;
use NutriScore\Models\Person\BmrCalculationType;
use NutriScore\Models\Person\Gender;
use NutriScore\Models\Person\Goal;
use NutriScore\Models\Person\NutritionType;
use NutriScore\Utils\CalculationsUtil;

class PersonCalculationService {
    public function getBodyMassIndex(int $height, int $weight): float {
        $heightInMeters = $height / 100;
        $divider = pow($heightInMeters, 2);
        return round($weight / $divider, 2);
    }

    public function getCalorieIntake(
        int $basalMetabolicRate,
        Goal $goal,
    ): int {
        return match ($goal) {
            Goal::KEEP => $basalMetabolicRate,
            Goal::GAIN => $basalMetabolicRate + 500,
            Goal::LOOSE => $basalMetabolicRate - 500,
        };
    }

    public function getProteinIntake(
        int $calorieIntake,
        int $percentage,
        NutritionType $nutritionType,
        int $weight,
        int $age,
        Gender $gender,
    ): int {
        if ($nutritionType === NutritionType::DACH_REFERENCE) {
            switch ($age) {
                case $age >= 4 && $age < 15:
                    return $weight * 0.9;
                case $age >= 15 && $age < 19:
                    if ($gender === Gender::MALE) {
                        return $weight * 0.9;
                    } else {
                        return $weight * 0.8;
                    }
                case $age >= 19 && $age <= 65:
                    return $weight * 0.8;
                case $age >= 1 && $age < 4:
                default:
                    return $weight;
            }
        } else {
            return CalculationsUtil::percentage($calorieIntake, $percentage) / 4;
        }
    }

    public function getCarbohydratesIntake(int $calorieIntake, $percentage): int {
        return (CalculationsUtil::percentage($calorieIntake, $percentage) / 4);
    }

    public function getFatIntake(int $calorieIntake, $percentage): int {
        return (CalculationsUtil::percentage($calorieIntake, $percentage) / 9);
    }

    public function getBasalMetabolicRate(
        int $restingMetabolicRate,
        ActivityLevel $activityLevel,
        ?int $palLevel,
    ): int {
        return match ($activityLevel) {
            ActivityLevel::NO_SPORTS => $restingMetabolicRate * 1.2,
            ActivityLevel::ONE_TO_THREE => $restingMetabolicRate * 1.375,
            ActivityLevel::THREE_TO_FIVE => $restingMetabolicRate * 1.55,
            ActivityLevel::SIX_TO_SEVEN => $restingMetabolicRate * 1.725,
            ActivityLevel::DAILY => $restingMetabolicRate * 1.9,
            ActivityLevel::PAL_LEVEL => $restingMetabolicRate * $palLevel,
            ActivityLevel::MET,
            ActivityLevel::MET_FACTOR,
            ActivityLevel::PAL_FACTOR => $restingMetabolicRate, // TODO Add recording of daily activity
        };
    }

    public function getRestingMetabolicRate(
        BmrCalculationType $bmrCalculationType,
        Gender $gender,
        int $weight,
        int $height,
        int $age
    ): int {
        return match ($bmrCalculationType) {
            BmrCalculationType::EASY => $this->getRmrEasy($gender, $weight),
            BmrCalculationType::COMPLICATED => $this->getRmrComplicated($gender, $weight, $age),
            BmrCalculationType::HARRIS_BENEDICT => $this->getRmrHarrisBenedict($gender, $weight, $age, $height),
            BmrCalculationType::MIFFLIN_ST_JEOR => $this->getRmrMifflinStJeor($gender, $weight, $age, $height)
        };
    }

    private function getRmrEasy(Gender $gender, int $weight): int {
        return match ($gender) {
            Gender::FEMALE => 700 + 7 * $weight,
            Gender::MALE => 900 + 10 * $weight,
            Gender::OTHER => 0 // to be implemented in later version
        };
    }

    private function getRmrComplicated(Gender $gender, int $weight, int $age): int {
        if ($gender === Gender::FEMALE) {
            return match (true) {
                ($age >= 10 && $age <= 18) => ($weight * 0.056 + 2.898) * 239,
                ($age >= 19 && $age <= 30) => ($weight * 0.062 + 2.036) * 239,
                ($age >= 31 && $age <= 60) => ($weight * 0.034 + 3.538) * 239,
                ($age >= 61) => ($weight * 0.038 + 2.755) * 239
            };
        } else if ($gender === Gender::MALE) {
            return match (true) {
                ($age >= 10 && $age <= 18) => ($weight * 0.074 + 2.754) * 239,
                ($age >= 19 && $age <= 30) => ($weight * 0.063 + 2.896) * 239,
                ($age >= 31 && $age <= 60) => ($weight * 0.048 + 3.653) * 239,
                ($age >= 61) => ($weight * 0.049 + 2.459) * 239
            };
        }
        return 0;
    }

    private function getRmrHarrisBenedict(Gender $gender, int $weight, int $age, int $height): int {
        return match ($gender) {
            Gender::FEMALE => 655.1 + (9.563 * $weight) + (1.85 * $height) - (4.676 * $age),
            Gender::MALE => 66.5 + (13.75 * $weight) + (5.003 * $height) - (6.775 * $age),
            Gender::OTHER => 0 // to be implemented in later version
        };
    }

    private function getRmrMifflinStJeor(Gender $gender, int $weight, int $age, int $height): int {
        $value = match($gender) {
            Gender::MALE => -5,
            Gender::FEMALE => 161,
            Gender::OTHER => 0
        };
        return ($height * 6.25) + ($weight * 9.99) - ($age * 4.92) - ($value);
    }
}