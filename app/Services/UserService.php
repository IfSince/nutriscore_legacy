<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Models\PrivatePerson\PrivatePerson;
use NutriScore\Models\User\User;
use NutriScore\Utils\Session;
use NutriScore\Validators\LoginFormValidator;
use NutriScore\Validators\RegisterFormValidator;

class UserService {
    private UserMapper $userMapper;
    private PrivatePersonService $privatePersonService;

    public function __construct() {
        $this->userMapper = new UserMapper();
        $this->privatePersonService = new PrivatePersonService();
    }

    public function findById(int $id): User {
        return $this->userMapper->findById($id);
    }

    public function validateAndLogin(array $formInput): array {
        $validator = new LoginFormValidator($formInput, $this->userMapper);
        $validator->validate();

        if ($validator->isValid()) {
            $user = $this->userMapper->findByUsername($formInput['username']);
            Session::set('id', $user->getId());
        }
        return $validator->getErrors();
    }

    public function validateAndRegister(array $formInput): array {
        $validator = new RegisterFormValidator($formInput, $this->userMapper);
        $validator->validate();

        if ($validator->isValid()) {
            $userToSave = $this->createUserForCreation($formInput);
            $savedUser = $this->userMapper->save($userToSave);

            $privatePerson = $this->createPrivatePersonForCreation($formInput, $savedUser);
            $this->privatePersonService->save($privatePerson);
        }
        return $validator->getErrors();
    }

    public function linkUserToProfileImage(int $userId, int $imageId): void {
       $this->userMapper->updateImage($userId, $imageId);
    }

    private function createUserForCreation(array $data): User {
        return new User(
            username: $data['username'],
            email: $data['email'],
            password: $data['password'],
            profileImageId: null,
        );
    }

    private function createPrivatePersonForCreation(array $data, User $user): PrivatePerson {
        return new PrivatePerson(
            userId: $user->getId(),
            first_name: $data['firstName'],
            surname: $data['surname'],
            date_of_birth: $data['dateOfBirth'],
            height: $data['height'],
            id: null,
            gender: $data['gender'],
            nutrition_type: $data['nutritionType'],
            bmr_calculation_type: $data['bmrCalculationType'],
            activity_level: $data['activityLevel'],
            goal: $data['goal'],
            accepted_tos: $data['acceptedTos']
        );
    }
}