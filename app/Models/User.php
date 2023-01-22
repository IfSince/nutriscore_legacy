<?php

class User {
    private Database $db;
    private string $id;
    private string $username;
    private string $email;
    private string $password;
    private string $joinedAt;

    public function __construct(Database $db = new Database()) {
        $this->db = $db;
    }

    public function existsByUsername(int|string $identifier): bool {
        $sql = "SELECT 1 FROM `users` WHERE lower(`username`) = lower(:identifier)";

        return $this->db->exists($sql, ['identifier' => $identifier]);
    }

    public function existsByUsernameAndPassword(string $username, string $password): bool {
        $sql = "SELECT 1
                  FROM users
                 WHERE lower(username) = lower(:username)
                   AND password = :password";

        return $this->db->exists($sql, ['username' => $username, 'password' => $password]);
    }

    public function getUserIdByUsername(string $username): int {
        $sql = "SELECT id FROM users WHERE username = :username";

        $userData = $this->db->fetch($sql, ['username' => $username]);

        return (int)$userData['id'];
    }

    // Returns a boolean indicating if the user could be found
    // If they were, saves their information in object's properties
    public function find(int|string $identifier): bool {
        $sql = "SELECT * FROM `users` WHERE `username` = :identifier";
        $userData = $this->db->fetch($sql, ['identifier' => $identifier]);

        foreach ($userData as $column => $value) {
            $this->{$column} = $value;
        }

        return true;
    }

    /**
     * @throws Exception
     */
    public function register(string $username, string $email, string $password): void {
        //
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
}
