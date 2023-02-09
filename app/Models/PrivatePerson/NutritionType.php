<?php

namespace NutriScore\Models\Person;

enum NutritionType: string {
    case NORMAL = 'NORMAL';
    case KETOGENIC = 'KETOGENIC';
    case LOW_CARB = 'LOW_CARB';
    case LOW_FAT = 'LOW_FAT';
    case HIGH_PROTEIN = 'HIGH_PROTEIN';
    case HP_HF = 'HP_HF';
    case MANUALLY = 'MANUALLY';
    case DACH_REFERENCE = 'DACH_REFERENCE';
}
