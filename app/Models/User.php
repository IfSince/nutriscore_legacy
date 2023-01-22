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

    // Returns a boolean indicating if the user could be found
    // If they were, saves their information in object's properties
    public function find(int|string $identifier): bool {
        $sql = "SELECT * FROM `users` WHERE `username` = :identifier";
        $this->db->query($sql, ['identifier' => $identifier]);

        if (!$this->db->count()) {
            return false;
        }
        $userData = $this->db->fetch();

        foreach ($userData as $column => $value) {
            $this->{$column} = $value;
        }

        return true;
    }

    public function usernameAlreadyTaken(int|string $identifier): bool {
        $sql = "SELECT 1 FROM `users` WHERE lower(`username`) = lower(:identifier)";

        return $this->db->exists($sql, ['identifier' => $identifier]);
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

        if (!$this->find($username)) {
            throw new Exception('The username is already taken');
        }
    }

    /**
     * @throws Exception
     */
    public function login(string $username, string $password): void {
        // Abgleich mit DB
        // Versuchen User zu finden
        if (!$this->find($username)) {
            throw new Exception('The username could not be found.');
        }

        // Passwörter abgleichen
        if (!password_verify($password, $this->password)) {
            throw new Exception('The password was incorrect.');
        }

        // Session erstellen
        $_SESSION['userId'] = (int)$this->id;
    }
}
