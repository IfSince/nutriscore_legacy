<?php

namespace NutriScore\Models\User;

enum UserType: string {
    case PRIVATE_PERSON = 'PRIVATE_PERSON';
    case PATIENT = 'PATIENT';
    case NUTRITIONIST = 'NUTRITIONIST';
}
