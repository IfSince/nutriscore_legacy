<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\PersonMapper;
use NutriScore\Models\Person\Person;

class PersonService {
    private PersonMapper $personMapper;

    public function __construct() {
        $this->personMapper = new PersonMapper();
    }

    public function findByUserId(int $userId): Person {
        return $this->personMapper->findByUserId($userId);
    }

    public function createAndSave(array $data): Person {
        $person = Person::create($data);
        $this->save($person);
        return $person;
    }

    public function save(Person $person): Person {
        $this->personMapper->save($person);
        return $person;
    }
}