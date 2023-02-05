<?php

namespace NutriScore\Utils;

use NutriScore\Models\PrivatePersons\PrivatePerson;
use NutriScore\Models\User\User;

class UserUtil {
    public static function createUserByFormInput(array $data): User {
        return new User(
            username: $data['username'],
            email: $data['email'],
            password: $data['password'],
            id: $data['userId'] ?? $data['id'] ?? null,
            image: ImageUtil::createImageByDatabaseResult($data),
        );
    }

    public static function createPrivatePersonByFormInput(array $formInput): PrivatePerson {
        return new PrivatePerson(
            user: self::createUserByFormInput($formInput),
            first_name: $formInput['firstName'],
            surname: $formInput['surname'],
            date_of_birth: $formInput['dateOfBirth'],
            height: $formInput['height'],
            id: $formInput['userId'] ?? $formInput['id'] ?? null,
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
            id: $data['user_id'] ?? $data['id'] ?? null,
            gender: $data['gender'],
            nutrition_type: $data['nutrition_type'],
            bmr_calculation_type: $data['bmr_calculation_type'],
            activity_level: $data['activity_level'],
            goal: $data['goal'],
            accepted_tos: $data['accepted_tos']
        );
    }

}