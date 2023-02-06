<?php

namespace NutriScore\DataMappers;

use NutriScore\Database;
use NutriScore\DataMapper;
use NutriScore\Models\Image\Image;
use NutriScore\Models\PrivatePerson\ActivityLevel;
use NutriScore\Models\PrivatePerson\BmrCalculationType;
use NutriScore\Models\PrivatePerson\Gender;
use NutriScore\Models\PrivatePerson\Goal;
use NutriScore\Models\PrivatePerson\NutritionType;
use NutriScore\Models\PrivatePerson\PrivatePerson;
use NutriScore\Models\User\User;
use NutriScore\Models\User\UserType;

class PrivatePersonMapper implements DataMapper {
    private Database $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function findById(int $id): PrivatePerson {
        $sql = 'SELECT pp.id, user_id, first_name, surname, date_of_birth, height, gender, nutrition_type, bmr_calculation_type,
                       activity_level, goal, accepted_tos, username, email, password, user_type, start_date, end_date, image_id, path, text
                  FROM private_persons pp
                  JOIN users u on pp.user_id = u.id
                  LEFT JOIN images i on u.image_id = i.id
                 WHERE pp.id = :id';
        $result = $this->database->fetch($sql, ['id' => $id]);

        return $this->mapRowToPrivatePerson($result);
    }

    public function findByUserId(int $userId): PrivatePerson {
        $sql = 'SELECT pp.id, user_id, first_name, surname, date_of_birth, height, gender, nutrition_type, bmr_calculation_type,
                       activity_level, goal, accepted_tos, username, email, password, user_type, start_date, end_date, image_id, path, text
                  FROM private_persons pp
                  JOIN users u on pp.user_id = u.id
                  LEFT JOIN images i on u.image_id = i.id
                 WHERE u.id = :userId';
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

    private function mapRowToPrivatePerson(array $data): PrivatePerson {
        $image = (isset($data['image_id'])) ? new Image(
            path: $data['path'],
            text: $data['text'],
            id: $data['image_id']
        ) : null;

        $user = new User(
            username: $data['username'],
            email: $data['email'],
            password: $data['password'],
            id: $data['user_id'],
            user_type: UserType::from($data['user_type']),
            start_date: $data['start_date'],
            end_date: $data['end_date'],
            image: $image
        );

        return new PrivatePerson(
            user: $user,
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