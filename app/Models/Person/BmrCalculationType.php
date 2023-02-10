<?php

namespace NutriScore\Models\Person;

enum BmrCalculationType: string {
    case EASY = 'EASY';
    case COMPLICATED = 'COMPLICATED';
    case HARRIS_BENEDICT = 'HARRIS_BENEDICT';
    case MIFFLIN_ST_JEOR = 'MIFFLIN_ST_JEOR';
}
