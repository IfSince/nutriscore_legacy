<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\PersonMapper;
use NutriScore\Models\Person\Person;
use NutriScore\Validators\PersonValidator;
use NutriScore\Validators\ValidationObject;

class PersonService {

    public function __construct(
        private readonly PersonMapper $personMapper,
        private readonly PersonValidator $validator,
    ) { }

    public function findByUserId(int $userId): Person {
        return $this->personMapper->findByUserId($userId);
    }

    public function save(Person $person): ValidationObject {
        $this->validator->validate($person);

        if ($this->validator->isValid()) {
            $this->personMapper->save($person);
        }
        return $this->validator->getValidationObject();
    }
}