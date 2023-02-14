<?php

namespace NutriScore\Utils;

use NutriScore\DataMappers\PersonMapper;
use NutriScore\Models\Person\Person;

class PersonUtil {
    public static function createOrUpdateByForm(array $form, int $id = null): Person {
        $personMapper = new PersonMapper();

        $person = $personMapper->findById($id);

        if (isset($person)) {
            Person::update($person, $form);
        } else {
            Person::create($form);
        }
        return $person;
    }
}