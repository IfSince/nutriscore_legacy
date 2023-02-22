<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Validators\ChangePasswordValidator;
use NutriScore\Validators\ValidationObject;

class ChangePasswordService {
    public function __construct(
        private readonly UserMapper $userMapper,
        private readonly ChangePasswordValidator $validator,
    ) { }

    public function changePassword(int $userId, array $data): ValidationObject {
        $user = $this->userMapper->findByIdOrThrow($userId);
        $data['user'] = $user;
        $this->validator->validate($data);

        if ($this->validator->isValid()) {
            $user->setPassword($data['newPassword']);
            $this->userMapper->save($user);
        }
        return $this->validator->getValidationObject();
    }
}