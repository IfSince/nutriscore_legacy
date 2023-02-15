<?php

namespace NutriScore\Models\User;

use NutriScore\Models\Model;
use NutriScore\Utils\EnumUtil;
use NutriScore\Utils\Session;

class User extends Model {
    private string $username;
    private string $email;
    private string $password;
    private UserType $userType = UserType::PERSON;
    private string $startDate;
    private ?string $endDate = null;
    private ?int $profileImageId = null;

    public function __construct() {
        $this->startDate = date('Y/m/d');
    }

    public static function update(Model $obj, array $data = null): void {
        if ($data) {
            User::populate($obj, $data);
        }
    }

    public static function create(array $data = null): User {
        $obj = new User();
        if ($data) {
            $obj = User::populate($obj, $data);
        }
        return $obj;
    }

    public static function isLoggedIn(): bool {
        return Session::exists('id');
    }

    public function getPasswordHashed(): string {
        return password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getUserType(): UserType {
        return $this->userType;
    }

    public function setUserType(UserType|string $userType): void {
        $this->userType = EnumUtil::mapEnumValue(UserType::class, $userType);
    }

    public function getStartDate(): string {
        return $this->startDate;
    }

    public function setStartDate(string $startDate): void {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?string {
        return $this->endDate;
    }

    public function setEndDate(?string $endDate): void {
        $this->endDate = $endDate;
    }

    public function getProfileImageId(): ?int {
        return $this->profileImageId;
    }

    public function setProfileImageId(?int $profileImageId): void {
        $this->profileImageId = $profileImageId;
    }
}
