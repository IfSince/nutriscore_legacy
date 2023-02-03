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

    public function findByUsername(string $username): ?User {
        $sql = 'SELECT * FROM users WHERE users.username = :username';
        $result = $this->database->fetch($sql, ['username' => $username]);
        return ($result) ? new User(...$result) : null;
    }

    public function save(User $user): User {
        if ($user->isNew()) {
            $user->setId($this->create($user));
        } else {
            $this->update($user);
        }

        return $this->findById($user->getId());
    }

    private function create(User $user): int {
        $passwordHash = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        $sql = 'INSERT INTO users (username, email, password)
                    VALUES (:username, :email, :password)';
        return $this->database->createAndReturnId($sql, [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $passwordHash
        ]);
    }

    private function update(User $user): void {
        $sql = 'UPDATE users u
                   SET u.username = :username,
                       u.email = :email
                 WHERE u.id = :id';

        $this->database->query($sql, [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'id' => $user->getId()
        ]);
    }
}