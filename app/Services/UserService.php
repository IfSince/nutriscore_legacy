<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Models\User;
use NutriScore\Utils\Session;
use NutriScore\Validators\LoginFormValidator;
use NutriScore\Validators\RegisterFormValidator;

class UserService {
    private UserMapper $userMapper;

    public function __construct() {
        $this->userMapper = new UserMapper();
    }

    public function findById(int $id): User {
        return $this->userMapper->findById($id);
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
        $validator->setRules([
            'username' => 'required|min:4|max:16|whitespaces',
            'email' => 'required|min:3|email',
            'password' => 'required|min:8|matches:repeatPassword|uppercase|lowercase|number|specialchar|noWhitespaces',
//            'repeatPassword' => 'matches:password',
//            'tos' => 'required',
//            'firstName' => 'required|min:2|max:100',
//            'surname' => 'required|min:2|max:100',
//            'gender' => 'required',
//            'dateOfBirth' => 'required',
//            'height' => 'required',
//            'startingWeight' => 'required',
//            'nutritionType' => 'required',
//            'bmr' => 'required',
//            'activityLevel' => 'required',
//            'objective' => 'required',
        ]);
        $validator->validate();

        if ($validator->isValid()) {
            $user = $this->createUserByFormInput($formInput);
            $this->userMapper->save($user);
        }
        return $validator->getErrors();
    }

    private function createUserByFormInput(array $formInput): User {
        return new User(
            id: null,
            username: $formInput['username'],
            email: $formInput['email'],
            password: $formInput['password'],
        );
    }

}