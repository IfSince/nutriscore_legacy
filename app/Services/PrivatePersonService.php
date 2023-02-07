<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\PrivatePersonMapper;
use NutriScore\Models\PrivatePerson\PrivatePerson;
use NutriScore\Models\User\User;

class PrivatePersonService {
    private PrivatePersonMapper $privatePersonMapper;

    public function __construct() {
        $this->privatePersonMapper = new PrivatePersonMapper();
    }

    public function findByUserId(int $userId): PrivatePerson {
        return $this->privatePersonMapper->findByUserId($userId);
    }

    public function createAndSave(array $data, User $user): PrivatePerson {
        $data['user_id'] = $user->getId();

        $privatePerson = $this->privatePersonMapper->create($data);
        $this->privatePersonMapper->save($privatePerson);

        return $privatePerson;
    }

    public function save(PrivatePerson $privatePerson): PrivatePerson {
        $this->privatePersonMapper->save($privatePerson);
        return $privatePerson;
    }
}