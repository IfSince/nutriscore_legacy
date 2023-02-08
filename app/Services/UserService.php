<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\UserMapper;
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
            $user = $this->userMapper->create($formInput);

            $this->userMapper->save($user);
            $this->privatePersonService->createAndSave($formInput, $user);

        }
        return $validator->getErrors();
    }

    public function linkUserToProfileImage(int $userId, int $imageId): void {
        $this->userMapper->updateImage($userId, $imageId);
    }
}