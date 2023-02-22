<?php

namespace NutriScore\DataMappers;

use NutriScore\DataMapper;
use NutriScore\Models\Person\Person;

class PersonMapper extends DataMapper {
    private const RELATED_TABLE = 'persons';

    public function __construct() {
        parent::__construct(self::RELATED_TABLE);
    }

    public function findByUserId(int $userId): ?Person {
        $sql = 'SELECT * FROM persons pp WHERE pp.user_id = :userId';
        $params = ['userId' => $userId];

        return $this->load($sql, $params);
    }

    protected function _create(array $data = null): Person {
        return Person::create($data);
    }

    protected function _insert(mixed $obj): void {
        $sql = 'INSERT INTO persons (
                             user_id,
                             first_name,
                             surname,
                             date_of_birth,
                             height,
                             gender,
                             nutrition_type,
                             bmr_calculation_type,
                             pal_level,
                             activity_level,
                             goal,
                             accepted_tos
                             )
                    VALUES(
                           :userId,
                           :firstName,
                           :surname,
                           :dateOfBirth,
                           :height,
                           :gender,
                           :nutritionType,
                           :bmrCalculationType,
                           :palLevel,
                           :activityLevel,
                           :goal,
                           :acceptedTos
                           )';
        $params = [
            'userId' => $obj->getUserId(),
            'firstName' => $obj->getFirstName(),
            'surname' => $obj->getSurname(),
            'dateOfBirth' => $obj->getDateOfBirth(),
            'height' => $obj->getHeight(),
            'gender' => $obj->getGender()->value,
            'nutritionType' => $obj->getNutritionType()->value,
            'bmrCalculationType' => $obj->getBmrCalculationType()->value,
            'palLevel' => $obj->getPalLevel(),
            'activityLevel' => $obj->getActivityLevel()->value,
            'goal' => $obj->getGoal()->value,
            'acceptedTos' => $obj->hasAcceptedTos()
        ];

        $this->database->prepareAndExecute($sql, $params);
        $obj->setId($this->database->lastInsertId());
    }

    protected function _update(mixed $obj): void {
        $sql = 'UPDATE persons pp
                   SET pp.user_id = :userId,
                       pp.first_name = :firstName,
                       pp.surname = :surname,
                       pp.date_of_birth = :dateOfBirth,
                       pp.height = :height,
                       pp.gender = :gender,
                       pp.nutrition_type = :nutritionType,
                       pp.bmr_calculation_type = :bmrCalculationType,
                       pp.activity_level = :activityLevel,
                       pp.pal_level = :palLevel,
                       pp.goal = :goal,
                       pp.accepted_tos = :acceptedTos
                 WHERE pp.id = :id';
        $params = [
            'userId' => $obj->getUserId(),
            'firstName' => $obj->getFirstName(),
            'surname' => $obj->getSurname(),
            'dateOfBirth' => $obj->getDateOfBirth(),
            'height' => $obj->getHeight(),
            'gender' => $obj->getGender()->value,
            'nutritionType' => $obj->getNutritionType()->value,
            'bmrCalculationType' => $obj->getBmrCalculationType()->value,
            'activityLevel' => $obj->getActivityLevel()->value,
            'palLevel' => $obj->getPalLevel(),
            'goal' => $obj->getGoal()->value,
            'acceptedTos' => $obj->hasAcceptedTos(),
            'id' => $obj->getId()
        ];

        $this->database->prepareAndExecute($sql, $params);
    }
}