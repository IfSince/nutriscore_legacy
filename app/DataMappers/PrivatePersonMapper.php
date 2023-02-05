<?php

namespace NutriScore\DataMappers;

use NutriScore\Database;
use NutriScore\DataMapper;
use NutriScore\Models\PrivatePersons\PrivatePerson;
use NutriScore\Utils\UserUtil;

class PrivatePersonMapper implements DataMapper {
    private Database $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function findAll(): array {
        $sql = 'SELECT *
                  FROM private_persons pp
                  JOIN users u on pp.user_id = u.id';
        $result = $this->database->fetchAll($sql);

        return array_map(function ($entity) {
            return new PrivatePerson(...$entity);
        }, $result);
    }

    public function findById(int $id): PrivatePerson {
        $sql = 'SELECT *
                  FROM private_persons pp
                  JOIN users u on pp.user_id = u.id
                 WHERE pp.id = :id';
        $result = $this->database->fetch($sql, ['id' => $id]);

        return new PrivatePerson(...$result);
    }

    public function findByUserId(int $userId): PrivatePerson {
        $sql = 'SELECT *
                  FROM private_persons pp
                  JOIN users u on pp.user_id = u.id
                  JOIN images i on u.image_id = i.id
                 WHERE u.id = :userId';
        $result = $this->database->fetch($sql, ['userId' => $userId]);

        return UserUtil::createPrivatePersonByDatabaseResult($result);
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
            'userId' => $privatePerson->getUser()->getId(),
            'firstName' => $privatePerson->getFirstName(),
            'surname' => $privatePerson->getSurname(),
            'dateOfBirth' => $privatePerson->getDateOfBirth(),
            'height' => $privatePerson->getHeight(),
            'gender' => $privatePerson->getGender()->value,
            'nutritionType' => $privatePerson->getNutritionType()->value,
            'bmrCalculationType' => $privatePerson->getBmrCalculationType()->value,
            'activityLevel' => $privatePerson->getActivityLevel()->value,
            'goal' => $privatePerson->getGoal()->value,
            'acceptedTos' => $privatePerson->getAcceptedTos()
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
            'accepted_tos' => $privatePerson->getAcceptedTos(),
        ]);
    }
}