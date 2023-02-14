<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\PersonMapper;
use NutriScore\Models\Person\Person;
use NutriScore\Validators\PersonValidator;
use NutriScore\Validators\ValidationObject;

class PersonService {
    private PersonMapper $personMapper;

    public function __construct() {
        $this->personMapper = new PersonMapper();
    }

    public function findByUserId(int $userId): Person {
        return $this->personMapper->findByUserId($userId);
    }

    public function save(Person $person): ValidationObject {
        $validator = new PersonValidator($person);
        $validator->validate();

        if ($validator->isValid()) {
            $this->personMapper->save($person);
        }

        return $validator->getValidationObject();
    }

    public function createOrUpdateUserByForm(array $data, int $personId = null): Person {
        $person = $this->personMapper->findById($personId);

        if (isset($person)) {
            Person::update($person, $data);
        } else {
            Person::create($data);
        }
        return $person;
    }
}