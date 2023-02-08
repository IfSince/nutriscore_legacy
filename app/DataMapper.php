<?php

namespace NutriScore;

use NutriScore\Models\Model;

abstract class DataMapper {
    protected Database $database;
    private string $table;

    public function __construct(string $table) {
        $this->table = $table;
        $this->database = new Database();
    }

    public function findById(int $id): ?Model {
        $sql = "SELECT * FROM {$this->table} t WHERE t.id = :id";
        $data = $this->database->fetch($sql, ['id' => $id]);

        $this->returnOptionalOf($data);
    }

    public function load(string $sql, array $values): ?Model {
        $data = $this->database->fetch($sql, $values);
        return $this->returnOptionalOf($data);
    }

    public function create(array $data = null): Model {
        $obj = $this->_create();
        if ($data) {
            $obj = $this->populate($obj, $data);
        }
        return $obj;
    }

    public function save(Model $obj): void {
        if ($obj->isNew()) {
            $this->_insert($obj);
        } else {
            $this->_update($obj);
        }
    }

    public function delete(Model $obj): void {
        $sql = "DELETE FROM {$this->table} t WHERE t.id = :id";
        $this->database->prepareAndExecute($sql, ['id' => $obj->getId()]);
    }

    private function returnOptionalOf(array $data): ?Model {
        if ($data) {
            return $this->create($data);
        } else {
            return null;
        }
    }

    abstract protected function populate(mixed $obj, array $data): Model;

    abstract protected function _create(): Model;

    abstract protected function _insert(mixed $obj): void;

    abstract protected function _update(mixed $obj): void;
}