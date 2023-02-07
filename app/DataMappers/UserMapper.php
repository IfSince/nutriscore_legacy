<?php

namespace NutriScore\DataMappers;

use NutriScore\DataMapper;
use NutriScore\Models\User\User;
use NutriScore\Utils\ArrayUtil;

class UserMapper extends DataMapper {
    private const RELATED_TABLE = 'users';
    private const RELATED_CLASS = User::class;

    public function __construct() {
        parent::__construct(self::RELATED_TABLE, self::RELATED_CLASS);
    }

    public function findByUsername(string $username): ?User {
        $sql = 'SELECT * FROM users u WHERE u.username = :username';
        $data = $this->database->fetch($sql, ['username' => $username]);

        if ($data) {
            return $this->create($data);
        } else {
            return null;
        }
    }

    public function findByEmail(string $email): ?User {
        $sql = 'SELECT * FROM users u WHERE u.email = :email';
        $data =  $this->database->fetch($sql, ['email' => $email]);

        if ($data) {
            return $this->create($data);
        } else {
            return null;
        }
    }

    public function updateImage(int $userId, int $imageId): void {
        $sql = 'UPDATE users u
                   SET u.profile_image_id = :imageId
                 WHERE u.id = :userId';
        $this->database->queryStatement($sql, [
            'userId' => $userId,
            'imageId' => $imageId
        ]);
    }

    protected function _create(): User {
        return new User();
    }

    protected function _insert(mixed $obj) {
        $sql = 'INSERT INTO users (username, email, password, user_type, start_date, end_date, profile_image_id)
                    VALUES(:username, :email, :password, :userType, :startDate, :endDate, :profileImageId)';
        $this->database->queryStatement(
            $sql,
            [
                'username' => $obj->getUsername(),
                'email' => $obj->getEmail(),
                'password' => $obj->getPasswordHashed(),
                'userType' => $obj->getUserType()->value,
                'startDate' => $obj->getStartDate(),
                'endDate' => $obj->getEndDate(),
                'profileImageId' => $obj->getProfileImageId(),
            ]
        );

        $obj->setId($this->database->lastInsertId());
    }

    protected function _update(mixed $obj) {
        $sql = 'UPDATE users u
                   SET u.username = :username,
                       u.email = :email,
                       u.password = :password,
                       u.user_type = :userType,
                       u.start_date = :startDate,
                       u.end_date = :endDate,
                       u.profile_image_id = :profileImageId
                 WHERE u.id = :id';
        $this->database->queryStatement(
            $sql,
            [
                'username' => $obj->getUsername(),
                'email' => $obj->getEmail(),
                'password' => $obj->getPasswordHashed(),
                'userType' => $obj->getUserType()->value,
                'startDate' => $obj->getStartDate(),
                'endDate' => $obj->getEndDate(),
                'profileImageId' => $obj->getProfileImageId(),
                'id' => $obj->getId()
            ]
        );
    }

    protected function _delete(mixed $obj) {
        $sql = 'DELETE FROM users u WHERE u.id = :id';
        $this->database->queryStatement($sql, ['id' => $obj->getId()]);
    }

    public function populate(mixed $obj, array $data): User {
        ArrayUtil::snakeCaseToCamelCaseKeys($data);

        if (isset($data['id'])) {
            $obj->setId($data['id']);
        }
        if (isset($data['username'])) {
            $obj->setUsername($data['username']);
        }
        if (isset($data['email'])) {
            $obj->setEmail($data['email']);
        }
        if (isset($data['password'])) {
            $obj->setPassword($data['password']);
        }
        if (isset($data['userType'])) {
            $obj->setUserType($data['userType']);
        }
        if (isset($data['startDate'])) {
            $obj->setStartDate($data['startDate']);
        }
        if (isset($data['endDate'])) {
            $obj->setEndDate($data['endDate']);
        }
        if (isset($data['profileImageId'])) {
            $obj->setProfileImageId($data['profileImageId']);
        }

        return $obj;
    }
}