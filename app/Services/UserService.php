<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Models\User;

class UserService {
    private UserMapper $userMapper;

    public function __construct() {
        $this->userMapper = new UserMapper();
    }

    public function findById(int $id): User {
        return $this->userMapper->findById($id);
    }

}