<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Models\User\User;
use NutriScore\Validators\UserValidator;
use NutriScore\Validators\ValidationObject;

class UserService {
    private UserMapper $userMapper;

    public function __construct() {
        $this->userMapper = new UserMapper();
    }

    public function loadOrThrow(int $id): User {
        return $this->userMapper->findByIdOrThrow($id);
    }

    public function save(User $user): ValidationObject {
        $validator = new UserValidator($user);
        $validator->validate();

        if ($validator->isValid()) {
            $this->userMapper->save($user);
        }
        return $validator->getValidationObject();
    }

    public function linkUserToProfileImage(int $userId, int $imageId): void {
        $this->userMapper->updateImage($userId, $imageId);
    }
}