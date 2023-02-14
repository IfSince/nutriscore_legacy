<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Utils\Session;
use NutriScore\Validators\LoginValidator;
use NutriScore\Validators\ValidationObject;

class LoginService {
    private UserMapper $userMapper;

    public function __construct() {
        $this->userMapper = new UserMapper();
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

}