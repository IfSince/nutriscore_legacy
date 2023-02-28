<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Models\User\User;
use NutriScore\Validators\UserValidator;
use NutriScore\Validators\ValidationObject;

final class UserService {

    public function __construct(
        private readonly UserMapper $userMapper,
        private readonly UserValidator $validator,
    ) { }

    public function loadOrThrow(int $id): User {
        return $this->userMapper->loadByIdOrThrow($id);
    }

    public function save(User $user): ValidationObject {
        $this->validator->validate($user);

        if ($this->validator->isValid()) {
            $this->userMapper->save($user);
        }
        return $this->validator->getValidationObject();
    }

    public function linkUserToProfileImage(int $userId, int $imageId): void {
        $this->userMapper->updateImage($userId, $imageId);
    }
}