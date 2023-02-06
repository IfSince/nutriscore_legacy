<?php

namespace NutriScore\Models\PrivatePerson;

enum Goal: string {
    case KEEP = 'KEEP';
    case GAIN = 'GAIN';
    case LOOSE = 'LOOSE';
}
