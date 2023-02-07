<?php

namespace NutriScore;

class DataMapper {
    protected Database $database;

    private string $table;
    private string $class;

    public function __construct(string $table, string $class) {
        $this->table = $table;
        $this->class = $class;

        $this->database = new Database();
    }

    public function findById(int $id): mixed {
        $sql = "SELECT * FROM {$this->table} t WHERE t.id = :id";

        return $this->database->fetchClass($sql, $this->class, ['id' => $id]);
    }
}