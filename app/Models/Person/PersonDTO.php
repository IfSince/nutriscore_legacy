<?php

namespace NutriScore\Models\Person;

use JsonSerializable;
use NutriScore\Models\MacroDistribution\MacroDistribution;
use NutriScore\Traits\JsonConvertable;

class PersonDTO implements JsonSerializable {
    use JsonConvertable;

    public function __construct(
        public MacroDistribution $macroDistribution,
        public int $weight,
        public int $height,
        public int $age,
        public float $bodyMassIndex,
        public int $restingMetabolicRate,
        public int $basalMetabolicRate,
        public int $calorieIntake,
        public int $proteinIntake,
        public int $carbohydratesIntake,
        public int $fatIntake,
    ) {
    }
}