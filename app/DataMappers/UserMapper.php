<?php

namespace NutriScore\DataMappers;

use NutriScore\DataMapper;
use NutriScore\Models\Model;
use NutriScore\Models\User\User;


class UserMapper extends DataMapper {
    private const RELATED_TABLE = 'users';

    public function __construct() {
        parent::__construct(self::RELATED_TABLE);
    }

    public function findByUsername(?string $username): ?User {
        $sql = 'SELECT * FROM users u WHERE u.username = :username';
        $params = ['username' => $username];

        return $this->load($sql, $params);
    }

    public function findByEmail(?string $email): ?User {
        $sql = 'SELECT * FROM users u WHERE u.email = :email';
        $params = ['email' => $email];

        return $this->load($sql, $params);
    }

    public function updateImage(int $userId, int $imageId): void {
        $sql = 'UPDATE users u
                   SET u.profile_image_id = :imageId
                 WHERE u.id = :userId';
        $params = ['userId' => $userId, 'imageId' => $imageId];

        $this->database->prepareAndExecute($sql, $params);
    }

    protected function _create(array $data = null): Model {
        return User::create($data);
    }

    protected function _insert(mixed $obj): void {
        $sql = 'INSERT INTO users (username, email, password, user_type, start_date, end_date, profile_image_id)
                    VALUES(:username, :email, :password, :userType, :startDate, :endDate, :profileImageId)';
        $params = [
            'username' => $obj->getUsername(),
            'email' => $obj->getEmail(),
            'password' => $obj->getPasswordHashed(),
            'userType' => $obj->getUserType()->value,
            'startDate' => $obj->getStartDate(),
            'endDate' => $obj->getEndDate(),
            'profileImageId' => $obj->getProfileImageId(),
        ];

        $this->database->prepareAndExecute($sql, $params);
        $obj->setId($this->database->lastInsertId());
    }

    protected function _update(mixed $obj): void {
        $sql = 'UPDATE users u
                   SET u.username = :username,
                       u.email = :email,
                       u.password = :password,
                       u.user_type = :userType,
                       u.start_date = :startDate,
                       u.end_date = :endDate,
                       u.profile_image_id = :profileImageId
                 WHERE u.id = :id';
        $params = [
            'username' => $obj->getUsername(),
            'email' => $obj->getEmail(),
            'password' => $obj->getPasswordHashed(),
            'userType' => $obj->getUserType()->value,
            'startDate' => $obj->getStartDate(),
            'endDate' => $obj->getEndDate(),
            'profileImageId' => $obj->getProfileImageId(),
            'id' => $obj->getId()
        ];

        $this->database->prepareAndExecute($sql, $params);
    }
}