<?php

class User {
    private Database $db;
    private string $id;
    private string $username;
    private string $email;
    private string $password;
    private string $fistName;
    private string $surname;
    private string $gender;
    private string $dateOfBirth;
    private string $height;
    private string $currentWeight;
    private string $nutritionType;
    private string $basalMetabolicRate;
    private string $activityLevel;
    private string $objective;
    private string $startDate;

    public function __construct(Database $db = new Database()) {
        $this->db = $db;
    }

    public function existsByUsername(int|string $identifier): bool {
        $sql = "SELECT 1 FROM `users` WHERE lower(`username`) = lower(:identifier)";

        return $this->db->exists($sql, ['identifier' => $identifier]);
    }

    public function getUserIdByUsername(string $username): int {
        $sql = "SELECT id FROM users WHERE username = :username";

        $userData = $this->db->fetch($sql, ['username' => $username]);

        return (int)$userData['id'];
    }

    public function findByUsernameAndFetch(string $username): bool {
        $sql = "SELECT * FROM users WHERE username = :username";
        $userData = $this->db->fetch($sql, ['username' => $username]);

        if (!$this->db->count()) {
            return false;
        }

        foreach ($userData as $column => $value) {
            $this->{$column} = $value;
        }

        return true;
    }

    public function register(string $username, string $email, string $password): void {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $values = [
            'username' => $username,
            'email' => $email,
            'password' => $passwordHash
        ];

        $sql = "INSERT INTO `users` (`username`, `email`, `password`)
                    VALUES (:username, :email, :password)
        ";

        $this->db->query($sql, $values);
    }

    public function login(string $username): void {
        // Session erstellen
        $_SESSION['userId'] = $this->getUserIdByUsername($username);
    }

    public function getPassword(): string {
        return $this->password;
    }
}
