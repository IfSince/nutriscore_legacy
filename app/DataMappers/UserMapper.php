<?php

namespace NutriScore\DataMappers;

use NutriScore\Database;
use NutriScore\DataMapper;
use NutriScore\Models\Image\Image;
use NutriScore\Models\User\User;
use NutriScore\Models\User\UserType;

class UserMapper implements DataMapper {
    private Database $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function findById(int $id): User {
        $sql = 'SELECT u.id, username, email, password, user_type, start_date, end_date, image_id, path, text
                  FROM users u
                  LEFT JOIN images i on u.image_id = i.id
                 WHERE u.id = :id';
        $result = $this->database->fetch($sql, ['id' => $id]);

        return $this->mapRowToUser($result);
    }

    public function findByUsername(string $username): ?User {
        $sql = 'SELECT u.id, username, email, password, user_type, start_date, end_date, image_id, path, text
                  FROM users u
                  LEFT JOIN images i on u.image_id = i.id
                 WHERE u.username = :username';
        $result = $this->database->fetch($sql, ['username' => $username]);
        return ($result) ? $this->mapRowToUser($result) : null;
    }

    public function findByEmail(string $email): ?User {
        $sql = 'SELECT u.id, username, email, password, user_type, start_date, end_date, image_id, path, text
                  FROM users u
                  LEFT JOIN images i on u.image_id = i.id
                 WHERE u.email = :email';
        $result = $this->database->fetch($sql, ['email' => $email]);
        return ($result) ? $this->mapRowToUser($result) : null;
    }

    public function save(User $user): User {
        if ($user->isNew()) {
            $user->setId($this->create($user));
        } else {
            $this->update($user);
        }

        return $this->findById($user->getId());
    }

    public function updateImage(int $userId, int $imageId): void {
        $sql = 'UPDATE users u
                   SET u.image_id = :imageId
                 WHERE u.id = :userId';
        $this->database->queryStatement($sql, [
            'userId' => $userId,
            'imageId' => $imageId
        ]);
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
            'image_id' => $user->getImage()?->getId(),
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

    private function mapRowToUser(array $data): User {
        $image = (isset($data['image_id'])) ? new Image(
            path: $data['path'],
            text: $data['text'],
            id: $data['image_id']
        ) : null;

        return new User(
            username: $data['username'],
            email: $data['email'],
            password: $data['password'],
            id: $data['id'],
            user_type: UserType::from($data['user_type']),
            start_date: $data['start_date'],
            end_date: $data['end_date'],
            image: $image
        );
    }
}