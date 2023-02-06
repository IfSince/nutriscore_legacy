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
            $privatePerson = $this->createPrivatePersonForCreation($formInput);

            $savedUser = $this->userMapper->save($privatePerson->getUser());

            $privatePerson->setUser($savedUser);
            $this->privatePersonService->save($privatePerson);
        }
        return $validator->getErrors();
    }

    public function linkUserToProfileImage(int $userId, int $imageId): void {
       $this->userMapper->updateImage($userId, $imageId);
    }

    private function createPrivatePersonForCreation(array $data): PrivatePerson {
        return new PrivatePerson(
            user: $this->createPersonForCreation($data),
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

    private function createPersonForCreation(array $data): User {
        return new User(
            username: $data['username'],
            email: $data['email'],
            password: $data['password'],
            id: null,
            image: null,
        );
    }
}