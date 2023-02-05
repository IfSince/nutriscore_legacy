<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\PrivatePersonMapper;
use NutriScore\Models\PrivatePersons\PrivatePerson;

class PrivatePersonService {
    private PrivatePersonMapper $privatePersonMapper;

    public function __construct() {
        $this->privatePersonMapper = new PrivatePersonMapper();
    }

    public function findByUserId(int $userId): PrivatePerson {
        return $this->privatePersonMapper->findByUserId($userId);
    }

    public function save(PrivatePerson $privatePerson): PrivatePerson {
        return $this->privatePersonMapper->save($privatePerson);
    }

}