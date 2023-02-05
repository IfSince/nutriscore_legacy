<?php

namespace NutriScore\Models\PrivatePersons;

enum ActivityLevel: string {
    case NO_SPORTS = 'NO_SPORTS';
    case ONE_TO_THREE = 'ONE_TO_THREE';
    case THREE_TO_FIVE = 'THREE_TO_FIVE';
    case SIX_TO_SEVEN = 'SIX_TO_SEVEN';
    case DAILY = 'DAILY';
    case PAL_LEVEL = 'PAL_LEVEL';
    case MET = 'MET';
    case MET_FACTOR = 'MET_FACTOR';
    case PAL_FACTOR = 'PAL_FACTOR';
}
