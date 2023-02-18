<?php

namespace NutriScore\Models\Diary;

enum TimeOfDay: string {
    case BREAKFAST = 'BREAKFAST';
    case LUNCH = 'LUNCH';
    case DINNER = 'DINNER';
    case SNACKS = 'SNACKS';
}
