<?php

namespace NutriScore\Models\PrivatePersons;

enum Goal: string {
    case KEEP = 'KEEP';
    case GAIN = 'GAIN';
    case LOOSE = 'LOOSE';
}
