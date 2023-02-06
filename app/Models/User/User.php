<?php

namespace NutriScore\Models\User;

use NutriScore\Models\Model;
use NutriScore\Utils\Session;

class User extends Model {
    private string $username;
    private string $email;
    private string $password;
    private UserType $userType;
    private string $startDate;
    private ?string $endDate;
    private ?int $profileImageId;

    public function __construct(
        string          $username,
        string          $email,
        string          $password,
        ?string         $id = null,
        UserType|string $user_type = UserType::PRIVATE_PERSON,
        ?string         $start_date = null,
        ?string         $end_date = null,
        ?int            $profileImageId = null,
    ) {
        $this->id = (int) $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->userType = $this->mapEnumValue(UserType::class, $user_type);
        $this->startDate = $start_date ?? date("Y-m-d H:i:s");
        $this->endDate = $end_date;
        $this->profileImageId = $profileImageId;
    }

    public static function isLoggedIn(): bool {
        return Session::exists('id');
    }

    public function createPasswordHash(): string {
        return password_hash($this->password, PASSWORD_DEFAULT);
    }

    /**
     * @return string
     */
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void {
        $this->password = $password;
    }

    /**
     * @return UserType
     */
    public function getUserType(): UserType {
        return $this->userType;
    }

    /**
     * @param UserType $userType
     */
    public function setUserType(UserType $userType): void {
        $this->userType = $userType;
    }

    /**
     * @return string
     */
    public function getStartDate(): string {
        return $this->startDate;
    }

    /**
     * @param string $startDate
     */
    public function setStartDate(string $startDate): void {
        $this->startDate = $startDate;
    }

    /**
     * @return string|null
     */
    public function getEndDate(): ?string {
        return $this->endDate;
    }

    /**
     * @param string|null $endDate
     */
    public function setEndDate(?string $endDate): void {
        $this->endDate = $endDate;
    }

    /**
     * @return int|null
     */
    public function getProfileImageId(): ?int {
        return $this->profileImageId;
    }

    /**
     * @param int|null $profileImageId
     */
    public function setProfileImageId(?int $profileImageId): void {
        $this->profileImageId = $profileImageId;
    }
}
