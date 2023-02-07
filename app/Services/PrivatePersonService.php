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
        $privatePerson = $this->createPrivatePersonForCreation($data, $user);
        return $this->save($privatePerson);
    }

    public function save(PrivatePerson $privatePerson): PrivatePerson {
        return $this->privatePersonMapper->save($privatePerson);
    }

    private function createPrivatePersonForCreation(array $data, User $user): PrivatePerson {
        $privatePerson = PrivatePerson::from($data);
        $privatePerson->setUserId($user->getId());
        return $privatePerson;
    }

}