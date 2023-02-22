<?php

namespace NutriScore\Models\Person;

use NutriScore\Models\MacroDistribution\MacroDistribution;

enum NutritionType: string {
    case NORMAL = 'NORMAL';
    case KETOGENIC = 'KETOGENIC';
    case LOW_CARB = 'LOW_CARB';
    case LOW_FAT = 'LOW_FAT';
    case HIGH_PROTEIN = 'HIGH_PROTEIN';
    case HP_HF = 'HP_HF';
    case MANUALLY = 'MANUALLY';
    case DACH_REFERENCE = 'DACH_REFERENCE';

    public function getMacroDistribution(): ?MacroDistribution {
        return match($this) {
            self::NORMAL => new MacroDistribution(15,  55, 30),
            self::KETOGENIC => new MacroDistribution(15,  5, 80),
            self::LOW_CARB => new MacroDistribution(30, 25, 45),
            self::LOW_FAT => new MacroDistribution(20,  70, 10),
            self::HIGH_PROTEIN => new MacroDistribution(35,  35, 30),
            self::HP_HF => new MacroDistribution(30,  15, 55),
            self::MANUALLY => null,
            self::DACH_REFERENCE => new MacroDistribution(10,  60, 30)
        };
    }
}
