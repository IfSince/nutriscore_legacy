<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Models\Image;
use NutriScore\Models\User\User;
use NutriScore\Utils\Session;
use NutriScore\Utils\UserUtil;
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
            $privatePerson = UserUtil::createPrivatePersonByFormInput($formInput);

            $savedUser = $this->userMapper->save($privatePerson->getUser());

            $privatePerson->setUser($savedUser);
            $this->privatePersonService->save($privatePerson);
        }
        return $validator->getErrors();
    }

    public function linkUserToProfileImage(int $userId, Image $image): User {
       $user = $this->userMapper->findById($userId);
       $user->setId(Session::get('id'));
       $user->setImage($image);

       return $this->userMapper->save($user);
    }
}