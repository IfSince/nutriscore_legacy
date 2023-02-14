<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Enums\MessageType;
use NutriScore\Models\User\User;
use NutriScore\Utils\Session;
use NutriScore\Validators\LoginValidator;
use NutriScore\Validators\UserValidator;
use NutriScore\Validators\ValidationObject;

class UserService {
    private UserMapper $userMapper;

    public function __construct() {
        $this->userMapper = new UserMapper();
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
            Session::flash('success', 'The changes were saved successfully. ', MessageType::SUCCESS);
        } else {
            Session::flash('error', 'The data contains one or more errors and was not saved.', MessageType::ERROR);
        }
        return $validator->getValidationObject();
    }

    public function login(array $formInput): ValidationObject {
        $validator = new LoginValidator($formInput, $this->userMapper);
        $validator->validate();

        if ($validator->isValid()) {
            $user = $this->userMapper->findByUsername($formInput['username']);
            Session::set('id', $user->getId());
        }
        return $validator->getValidationObject();
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