<?php

namespace NutriScore\DataMappers;

use NutriScore\Database;
use NutriScore\DataMapper;
use NutriScore\Models\User\User;
use NutriScore\Utils\UserUtil;

class UserMapper implements DataMapper {
    private Database $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function findAll(): array {
        $sql = 'SELECT *
                  FROM users
                  LEFT JOIN images i on users.image_id = i.id';
        $result = $this->database->fetchAll($sql);

        return array_map(function ($entity) {
            return UserUtil::createUserByFormInput($entity);
        }, $result);
    }

    public function findById(int $id): User {
        $sql = 'SELECT *
                  FROM users
                  LEFT JOIN images i on users.image_id = i.id
                 WHERE users.id = :id';
        $result = $this->database->fetch($sql, ['id' => $id]);

        return UserUtil::createUserByFormInput($result);
    }

    public function findByUsername(string $username): ?User {
        $sql = 'SELECT *
                  FROM users
                  LEFT JOIN images i on users.image_id = i.id
                 WHERE users.username = :username';
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
        $sql = 'INSERT INTO users (username, email, password, user_type, start_date, end_date, image_id)
                    VALUES (:username, :email, :password, :user_type, :start_date, :end_date, :image_id)';
        return $this->database->createAndReturnId($sql, [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->createPasswordHash(),
            'user_type' =>  $user->getUserType()->value,
            'start_date' => $user->getStartDate(),
            'end_date' => $user->getEndDate(),
            'image_id' => $user->getImage()->getId(),
        ]);
    }

    private function update(User $user): void {
        $sql = 'UPDATE users u
                   SET u.username = :username,
                       u.email = :email,
                       u.start_date = :start_date,
                       u.end_date = :end_date,
                       u.image_id = :image_id
                 WHERE u.id = :id';

        $this->database->queryStatement($sql, [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'start_date' => $user->getStartDate(),
            'end_date' => $user->getEndDate(),
            'image_id' => $user->getImage()->getId(),
        ]);
    }
}