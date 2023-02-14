<?php

namespace NutriScore\Utils;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Models\User\User;

class UserUtil {
    public static function createOrUpdateByForm(array $form, int $id = null): User {
        $userMapper = new UserMapper();

        $user = $userMapper->findById($id);

        if (isset($user)) {
            User::update($user, $form);
        } else {
            User::create($form);
        }
        return $user;
    }

}