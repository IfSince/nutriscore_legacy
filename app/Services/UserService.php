<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Models\RegisterFormValidator;
use NutriScore\Models\User;

class UserService {
    private UserMapper $userMapper;

    public function __construct() {
        $this->userMapper = new UserMapper();
    }

    public function findById(int $id): User {
        return $this->userMapper->findById($id);
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
            $user = new User(
                id: null,
                username: $formInput['username'],
                email: $formInput['email'],
                password: $formInput['password'],
            );

            $this->userMapper->save($user);
        }
        return $validator->getErrors();
    }

}