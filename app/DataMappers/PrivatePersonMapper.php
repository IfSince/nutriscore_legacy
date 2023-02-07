<?php

namespace NutriScore\DataMappers;

use NutriScore\DataMapper;
use NutriScore\Models\PrivatePerson\PrivatePerson;

class PrivatePersonMapper extends DataMapper {
    private const RELATED_TABLE = 'private_persons';
    private const RELATED_CLASS = PrivatePerson::class;

    public function __construct() {
        parent::__construct(self::RELATED_TABLE, self::RELATED_CLASS);
    }

    public function findByUserId(int $userId): PrivatePerson {
        $sql = 'SELECT * FROM private_persons pp  WHERE pp.user_id = :userId';
        return $this->database->fetchClass($sql, self::RELATED_CLASS, ['userId' => $userId]);
    }

    public function save(PrivatePerson $privatePerson): PrivatePerson {
        if ($privatePerson->isNew()) {
            $privatePerson->setId($this->create($privatePerson));
        } else {
            $this->update($privatePerson);
        }

        return $this->findById($privatePerson->getId());
    }

    private function create(PrivatePerson $privatePerson): int {
        $sql = 'INSERT INTO private_persons (
                             user_id,
                             first_name,
                             surname,
                             date_of_birth,
                             height,
                             gender,
                             nutrition_type,
                             bmr_calculation_type,
                             activity_level,
                             goal,
                             accepted_tos
                             )
                    VALUES (
                            :userId,
                            :firstName,
                            :surname,
                            :dateOfBirth,
                            :height,
                            :gender,
                            :nutritionType,
                            :bmrCalculationType,
                            :activityLevel,
                            :goal,
                            :acceptedTos
                            )';
        return $this->database->createAndReturnId($sql, [
            'userId' => $privatePerson->getUserId(),
            'firstName' => $privatePerson->getFirstName(),
            'surname' => $privatePerson->getSurname(),
            'dateOfBirth' => $privatePerson->getDateOfBirth(),
            'height' => $privatePerson->getHeight(),
            'gender' => $privatePerson->getGender()->value,
            'nutritionType' => $privatePerson->getNutritionType()->value,
            'bmrCalculationType' => $privatePerson->getBmrCalculationType()->value,
            'activityLevel' => $privatePerson->getActivityLevel()->value,
            'goal' => $privatePerson->getGoal()->value,
            'acceptedTos' => $privatePerson->hasAcceptedTos()
        ]);
    }

    private function update(PrivatePerson $privatePerson): void {
        $sql = 'UPDATE private_persons pp
                   SET pp.first_name = :firstName,
                       pp.surname = :surname,
                       pp.date_of_birth = :dateOfBirth,
                       pp.height = :height,
                       pp.gender = :gender,
                       pp.nutrition_type = :nutritionType,
                       pp.bmr_calculation_type = :bmrCalculationType,
                       pp.activity_level = :activityLevel,
                       pp.goal = :goal,
                       pp.accepted_tos = :acceptedTos
                 WHERE pp.id = :id';

        $this->database->queryStatement($sql, [
            'firstName' => $privatePerson->getFirstName(),
            'surname' => $privatePerson->getSurname(),
            'dateOfBirth' => $privatePerson->getDateOfBirth(),
            'height' => $privatePerson->getHeight(),
            'gender' => $privatePerson->getGender()->value,
            'nutritionType' => $privatePerson->getNutritionType()->value,
            'bmrCalculationType' => $privatePerson->getBmrCalculationType()->value,
            'activityLevel' => $privatePerson->getActivityLevel()->value,
            'goal' => $privatePerson->getGoal()->value,
            'accepted_tos' => $privatePerson->hasAcceptedTos(),
        ]);
    }
}