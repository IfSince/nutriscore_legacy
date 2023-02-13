<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Models\User\User;
use NutriScore\Utils\Session;
use NutriScore\Validators\LoginFormValidator;
use NutriScore\Validators\RegisterFormValidator;
use NutriScore\Validators\UserValidator;
use NutriScore\Validators\ValidationObject;

class UserService {
    private UserMapper $userMapper;
    private PersonService $personService;
    private WeightRecordingService $weightRecordingService;

    public function __construct() {
        $this->userMapper = new UserMapper();
        $this->personService = new PersonService();
        $this->weightRecordingService = new WeightRecordingService();
    }

    public function findById(int $id): User {
        return $this->userMapper->findById($id);
    }

    public function update(array $data): ValidationObject {
        $userId = Session::get('id');
        $user = $this->findById($userId);
        User::update($user, $data);

        $validator = new UserValidator($user, $this->userMapper);
        $validator->validate();

        if ($validator->isValid()) {
            $this->userMapper->save($user);
        }

        return $validator->getValidationObject();
    }

    public function login(array $formInput): array {
        $validator = new LoginFormValidator($formInput, $this->userMapper);
        $validator->validate();

        if ($validator->isValid()) {
            $user = $this->userMapper->findByUsername($formInput['username']);
            Session::set('id', $user->getId());
        }
        return $validator->getErrors();
    }

    public function register(array $formInput): array {
        $validator = new RegisterFormValidator($formInput, $this->userMapper);
        $validator->validate();

        if ($validator->isValid()) {
            $user = User::create($formInput);
            $this->userMapper->save($user);
            $formInput['user_id'] = $user->getId();

            $this->personService->createAndSave($formInput);
            $this->weightRecordingService->createAndSave($formInput);
        }
        return $validator->getErrors();
    }

    public function linkUserToProfileImage(int $userId, int $imageId): void {
        $this->userMapper->updateImage($userId, $imageId);
    }
}