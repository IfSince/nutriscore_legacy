<?php

namespace NutriScore;

abstract class DataMapper {
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

        $data = $this->database->fetch($sql, ['id' => $id]);

        if ($data) {
            return $this->create($data);
        } else {
            return null;
        }
    }

    public function create(array $data = null) {
        $obj = $this->_create();
        if ($data) {
            $obj = $this->populate($obj, $data);
        }

        return $obj;
    }

    public function save(mixed $obj): void {
        if ($obj->isNew()) {
            $this->_insert($obj);
        } else {
            $this->_update($obj);
        }
    }

    public function delete(mixed $obj): void {
        $this->_delete($obj);
    }

    abstract public function populate(mixed $obj, array $data);

    abstract protected function _create();

    abstract protected function _insert(mixed $obj);

    abstract protected function _update(mixed $obj);

    abstract protected function _delete(mixed $obj);
}