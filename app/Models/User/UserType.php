<?php

namespace NutriScore\Models\User;

enum UserType: string {
    case PERSON = 'PERSON';
    case PATIENT = 'PATIENT';
    case NUTRITIONIST = 'NUTRITIONIST';
}
