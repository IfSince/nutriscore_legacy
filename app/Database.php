<?php

namespace NutriScore;

use PDO;
use PDOException;
use PDOStatement;

class Database extends PDO {
    private string $host = 'localhost';
    private string $databaseName = 'nutriscore';
    private string $charset = 'utf8mb4';
    private string $username = 'root';
    private string $password = '';

    private PDOStatement $statement;

    public function __construct() {
        try {
            parent::__construct(
                "mysql:host=$this->host;dbname=$this->databaseName;charset=$this->charset",
                $this->username,
                $this->password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function queryStatement(string $sql, array $values = []): void {
        $this->statement = $this->prepare($sql);
        $this->statement->execute($values);
    }

    public function count(): int {
        return $this->statement->rowCount();
    }

    public function exists(string $sql, array $values = []): bool {
        $this->queryStatement($sql, $values);
        return $this->count() > 0;
    }

    public function fetch(string $sql, array $values = []): mixed {
        $this->queryStatement($sql, $values);
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchClass(string $sql, string $class, array $values = []): mixed {
        $this->queryStatement($sql, $values);

        $result = $this->statement->fetch(PDO::FETCH_ASSOC);

        return $class::from($result);
    }

    public function fetchAll(string $sql, array $values = []): array {
        $this->queryStatement($sql, $values);
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createAndReturnId(string $sql, array $values = []): int {
        $this->queryStatement($sql, $values);
        return $this->lastInsertId();
    }
}
