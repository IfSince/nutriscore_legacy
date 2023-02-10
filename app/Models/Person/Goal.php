<?php

namespace NutriScore\Models\Person;

enum Goal: string {
    case KEEP = 'KEEP';
    case GAIN = 'GAIN';
    case LOOSE = 'LOOSE';
}
