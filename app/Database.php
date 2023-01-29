<?php

namespace NutriScore;

use PDO;
use PDOException;
use PDOStatement;


require_once __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'database.php';

class Database {
    private string $host = HOST;
    private string $databaseName = DB_NAME;
    private string $charset = DB_CHARSET;
    private string $username = DB_USER;
    private string $password = DB_PASSWORD;

    private PDO $pdo;
    private PDOStatement $statement;

    public function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host=$this->host;dbname=$this->databaseName;charset=$this->charset",
                $this->username,
                $this->password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query(string $sql, array $values = []): void {
        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute($values);
    }

    public function count(): int {
        return $this->statement->rowCount();
    }

    public function exists(string $sql, array $values = []): bool {
        $this->query($sql, $values);
        return $this->count() > 0;
    }

    public function fetch(string $sql, array $values = []): mixed {
        $this->query($sql, $values);
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }
}
