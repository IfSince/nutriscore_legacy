<?php

namespace NutriScore\DataMappers;

use NutriScore\DataMapper;
use NutriScore\Models\PrivatePerson\PrivatePerson;
use NutriScore\Utils\ArrayUtil;

class PrivatePersonMapper extends DataMapper {
    private const RELATED_TABLE = 'private_persons';
    private const RELATED_CLASS = PrivatePerson::class;

    public function __construct() {
        parent::__construct(self::RELATED_TABLE, self::RELATED_CLASS);
    }

    public function findByUserId(int $userId): PrivatePerson {
        $sql = 'SELECT * FROM private_persons pp WHERE pp.user_id = :userId';
        $data = $this->database->fetch($sql, ['userId' => $userId]);

        return $this->create($data);
    }

    protected function _create(): PrivatePerson {
        return new PrivatePerson();
    }

    protected function _insert(mixed $obj) {
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
                    VALUES(
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

        $this->database->queryStatement(
            $sql,
            [
                'userId' => $obj->getUserId(),
                'firstName' => $obj->getFirstName(),
                'surname' => $obj->getSurname(),
                'dateOfBirth' => $obj->getDateOfBirth(),
                'height' => $obj->getHeight(),
                'gender' => $obj->getGender()->value,
                'nutritionType' => $obj->getNutritionType()->value,
                'bmrCalculationType' => $obj->getBmrCalculationType()->value,
                'activityLevel' => $obj->getActivityLevel()->value,
                'goal' => $obj->getGoal()->value,
                'acceptedTos' => $obj->hasAcceptedTos()
            ]
        );

        $obj->setId($this->database->lastInsertId());
    }

    protected function _update(mixed $obj) {
        $sql = 'UPDATE private_persons pp
                   SET pp.user_id = :userId,
                       pp.first_name = :firstName,
                       pp.surname = :surname,
                       pp.date_of_birth = :dateOfBirth,
                       pp.height = :height,
                       pp.gender = :gender,
                       pp.nutrition_type = :nutritionType,
                       pp.bmr_calculation_type = :bmrCalculationType,
                       pp.activity_level = :activityLevel,
                       pp.goal = :goal,
                       pp.accepted_tos = :acceptedTos
                 WHERE pp.id = :id
                       ';
        $this->database->queryStatement(
            $sql,
            [
                'userId' => $obj->getUserId(),
                'firstName' => $obj->getFirstName(),
                'surname' => $obj->getSurname(),
                'dateOfBirth' => $obj->getDateOfBirth(),
                'height' => $obj->getHeight(),
                'gender' => $obj->getGender()->value,
                'nutritionType' => $obj->getNutritionType()->value,
                'bmrCalculationType' => $obj->getBmrCalculationType()->value,
                'activityLevel' => $obj->getActivityLevel()->value,
                'goal' => $obj->getGoal()->value,
                'acceptedTos' => $obj->hasAcceptedTos(),
                'id' => $obj->getId()
            ]
        );
    }

    protected function _delete(mixed $obj) {
        $sql = 'DELETE FROM private_persons pp WHERE pp.id = :id';
        $this->database->queryStatement($sql, ['id' => $obj->getId()]);
    }

    public function populate(mixed $obj, array $data) {
        ArrayUtil::snakeCaseToCamelCaseKeys($data);

        if (isset($data['id'])) {
            $obj->setId($data['id']);
        }
        if (isset($data['userId'])) {
            $obj->setUserId($data['userId']);
        }
        if (isset($data['firstName'])) {
            $obj->setFirstName($data['firstName']);
        }
        if (isset($data['surname'])) {
            $obj->setSurname($data['surname']);
        }
        if (isset($data['dateOfBirth'])) {
            $obj->setDateOfBirth($data['dateOfBirth']);
        }
        if (isset($data['height'])) {
            $obj->setHeight($data['height']);
        }
        if (isset($data['gender'])) {
            $obj->setGender($data['gender']);
        }
        if (isset($data['nutritionType'])) {
            $obj->setNutritionType($data['nutritionType']);
        }
        if (isset($data['bmrCalculationType'])) {
            $obj->setBmrCalculationType($data['bmrCalculationType']);
        }
        if (isset($data['activityLevel'])) {
            $obj->setActivityLevel($data['activityLevel']);
        }
        if (isset($data['goal'])) {
            $obj->setGoal($data['goal']);
        }
        if (isset($data['acceptedTos'])) {
            $obj->setAcceptedTos($data['acceptedTos']);
        }

        return $obj;
    }
}