<?php

namespace NutriScore\Utils;

use NutriScore\Models\PrivatePersons\PrivatePerson;
use NutriScore\Models\User\User;

class UserUtil {
    public static function createUserByFormInput(array $formInput): User {
        return new User(
            username: $formInput['username'],
            email: $formInput['email'],
            password: $formInput['password'],
        );
    }

    public static function createPrivatePersonByFormInput(array $formInput): PrivatePerson {
        return new PrivatePerson(
            user: self::createUserByFormInput($formInput),
            first_name: $formInput['firstName'],
            surname: $formInput['surname'],
            date_of_birth: $formInput['dateOfBirth'],
            height: $formInput['height'],
            gender: $formInput['gender'],
            nutrition_type: $formInput['nutritionType'],
            bmr_calculation_type: $formInput['bmrCalculationType'],
            activity_level: $formInput['activityLevel'],
            goal: $formInput['goal'],
            accepted_tos: $formInput['acceptedTos']
        );
    }

    public static function createPrivatePersonByDatabaseResult(array $data): PrivatePerson {
        return new PrivatePerson(
            user: self::createUserByFormInput($data),
            first_name: $data['first_name'],
            surname: $data['surname'],
            date_of_birth: $data['date_of_birth'],
            height: $data['height'],
            gender: $data['gender'],
            nutrition_type: $data['nutrition_type'],
            bmr_calculation_type: $data['bmr_calculation_type'],
            activity_level: $data['activity_level'],
            goal: $data['goal'],
            accepted_tos: $data['accepted_tos']
        );
    }

}