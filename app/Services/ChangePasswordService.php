<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Validators\ChangePasswordValidator;
use NutriScore\Validators\ValidationObject;

class ChangePasswordService {
    private UserMapper $userMapper;

    public function __construct() {
        $this->userMapper = new UserMapper();
    }

    public function changePassword(int $userId, array $data): ValidationObject {
        $user = $this->userMapper->findById($userId);

        $validator = new ChangePasswordValidator($data, $user);
        $validator->validate();

        if ($validator->isValid()) {
            $user->setPassword($data['newPassword']);
            $this->userMapper->save($user);
        }
        return $validator->getValidationObject();
    }
}