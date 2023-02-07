<?php

namespace NutriScore\DataMappers;

use NutriScore\DataMapper;
use NutriScore\Models\User\User;

class UserMapper extends DataMapper {
    private const RELATED_TABLE = 'users';
    private const RELATED_CLASS = User::class;

    public function __construct() {
        parent::__construct(self::RELATED_TABLE, self::RELATED_CLASS);
    }

    public function findByUsername(string $username): ?User {
        $sql = 'SELECT * FROM users u WHERE u.username = :username';
        return $this->database->fetchClass($sql, self::RELATED_CLASS, ['username' => $username]);
    }

    public function findByEmail(string $email): ?User {
        $sql = 'SELECT * FROM users u WHERE u.email = :email';
        return $this->database->fetchClass($sql, self::RELATED_CLASS, ['email' => $email]);
    }

    public function save(User &$user): User {
        if ($user->isNew()) {
            $user->setId($this->create($user));
        } else {
            $this->update($user);
        }

        return $this->findById($user->getId());
    }

    public function updateImage(int $userId, int $imageId): void {
        $sql = 'UPDATE users u
                   SET u.profile_image_file_id = :imageId
                 WHERE u.id = :userId';
        $this->database->queryStatement($sql, [
            'userId' => $userId,
            'imageId' => $imageId
        ]);
    }

    private function create(User $user): int {
        $sql = 'INSERT INTO users (username, email, password, user_type, start_date, profile_image_file_id)
                    VALUES (:username, :email, :password, :userType, :startDate, :profileImageId)';

        return $this->database->createAndReturnId($sql, [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->createPasswordHash(),
            'userType' =>  $user->getUserType()->value,
            'startDate' => $user->getStartDate(),
            'profileImageId' => $user->getProfileImageId(),
        ]);
    }

    private function update(User $user): void {
        $sql = 'UPDATE users u
                   SET u.username = :username,
                       u.email = :email,
                       u.start_date = :startDate,
                       u.end_date = :endDate,
                       u.profile_image_file_id = :profileImageId
                 WHERE u.id = :id';

        $this->database->queryStatement($sql, [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'startDate' => $user->getStartDate(),
            'endDate' => $user->getEndDate(),
            'profileImageId' => $user->getProfileImageId(),
        ]);
    }
}