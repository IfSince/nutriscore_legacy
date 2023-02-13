<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\PersonMapper;
use NutriScore\Enums\MessageType;
use NutriScore\Models\Person\Person;
use NutriScore\Utils\Session;
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

    public function updateAndSave(array $data, int $personId): ValidationObject {
        $person = $this->personMapper->findById($personId);
        Person::update($person, $data);

        $validator = new PersonValidator($person);
        $validator->validate();

        if ($validator->isValid()) {
            $this->personMapper->save($person);
            Session::flash('success', 'The changes were saved successfully. ', MessageType::SUCCESS);
        } else {
            Session::flash('error', 'The data contains one or more errors and was not saved.', MessageType::ERROR);
        }

        return $validator->getValidationObject();
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