<?php

namespace NutriScore;

use PDO;
use PDOException;
use PDOStatement;

final class Database extends PDO {
    private PDOStatement $statement;

    public function __construct() {
        try {
            parent::__construct(
                $_ENV['DB_DNS'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASSWORD'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function prepareAndExecute(string $sql, array $values = []): void {
        $this->statement = $this->prepare($sql);
        $this->statement->execute($values);
    }

    public function count(): int {
        return $this->statement->rowCount();
    }

    public function exists(string $sql, array $values = []): bool {
        $this->prepareAndExecute($sql, $values);
        return $this->count() > 0;
    }

    public function fetch(string $sql, array $values = []): mixed {
        $this->prepareAndExecute($sql, $values);
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll(string $sql, array $values = []): bool|array {
        $this->prepareAndExecute($sql, $values);
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
