<?php

namespace NutriScore\DataMappers;

use NutriScore\Database;
use NutriScore\DataMapper;
use NutriScore\Models\PrivatePerson\ActivityLevel;
use NutriScore\Models\PrivatePerson\BmrCalculationType;
use NutriScore\Models\PrivatePerson\Gender;
use NutriScore\Models\PrivatePerson\Goal;
use NutriScore\Models\PrivatePerson\NutritionType;
use NutriScore\Models\PrivatePerson\PrivatePerson;

class PrivatePersonMapper implements DataMapper {
    private Database $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function findById(int $id): PrivatePerson {
        $sql = 'SELECT * FROM private_persons pp WHERE pp.id = :id';
        $result = $this->database->fetch($sql, ['id' => $id]);

        return $this->mapRowToPrivatePerson($result);
    }

    public function findByUserId(int $userId): PrivatePerson {
        $sql = 'SELECT * FROM private_persons pp  WHERE pp.user_id = :userId';
        $result = $this->database->fetch($sql, ['userId' => $userId]);

        return $this->mapRowToPrivatePerson($result);
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

    private function mapRowToPrivatePerson(array $data): PrivatePerson {
        return new PrivatePerson(
            userId: $data['user_id'],
            first_name: $data['first_name'],
            surname: $data['surname'],
            date_of_birth: $data['date_of_birth'],
            height: $data['height'],
            id: $data['id'],
            gender: Gender::from($data['gender']),
            nutrition_type: NutritionType::from($data['nutrition_type']),
            bmr_calculation_type: BmrCalculationType::from($data['bmr_calculation_type']),
            activity_level: ActivityLevel::from($data['activity_level']),
            goal: Goal::from($data['goal']),
            accepted_tos: $data['accepted_tos']
        );
    }
}