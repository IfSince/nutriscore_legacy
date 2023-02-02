<?php

namespace NutriScore\DataMappers;

use NutriScore\Database;
use NutriScore\DataMapper;
use NutriScore\Models\User;

class UserMapper implements DataMapper {
    private Database $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function findAll(): array {
        $sql = 'SELECT * FROM users';
        $result = $this->database->fetchAll($sql);

        return array_map(function ($entity) {
            return new User(...$entity);
        }, $result);
    }

    public function findById(int $id): User {
        $sql = 'SELECT * FROM users WHERE users.id = :id';
        $result = $this->database->fetch($sql, ['id' => $id]);
        return new User(...$result);
    }

    public function save(User $entity): User {
        // TODO: Implement save() method.
    }
}