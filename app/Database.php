<?php

class Database {
    private string $host = 'localhost';
    private string $databaseName = 'nutriscore';
    private string $charset = 'utf8mb4';
    private string $username = 'root';
    private string $password = '';

    private PDO $pdo;
    private PDOStatement $statement;

    public function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->databaseName};charset={$this->charset}",
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
        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute($values);

        return $this->count() > 0;
    }

    public function fetchAll(): array {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch(): mixed {
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }
}
