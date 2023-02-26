<?php

namespace NutriScore;

use Exception;
use NutriScore\Exceptions\NotFoundException;
use NutriScore\Models\Model;
use Throwable;

abstract class DataMapper {
    private readonly string $table;

    public function __construct(
        string             $table,
        protected Database $database
    ) {
        $this->table = $table;
    }

    public function loadById(int $id): ?Model {
        $sql = "SELECT * FROM $this->table t WHERE t.id = :id";
        $data = $this->database->fetch($sql, ['id' => $id]);

        return $this->returnOptionalOf($data);
    }

    /**
     * @throws NotFoundException|Exception
     */
    public function loadByIdOrThrow(int $id): Model {
        try {
            $sql = "SELECT * FROM $this->table t WHERE t.id = :id";
            $data = $this->database->fetch($sql, ['id' => $id]);

            if (!$data) {
                throw new NotFoundException("The entity with id $id could not be found.", 404);
            }
            return $this->_create($data);

        } catch (NotFoundException $e) {
            throw $e;
        } catch (Throwable) {
            throw new Exception("Something went wrong when trying to access the database.", 404);
        }
    }

    public function loadAllByIds(array $ids): array {
        $sql = "SELECT * FROM $this->table t WHERE t.id IN (:ids)";
        $params = ['ids' => implode(', ', $ids)];

        return $this->loadAll($sql, $params);
    }

    public function load(string $sql, array $values): ?Model {
        $data = $this->database->fetch($sql, $values);
        return $this->returnOptionalOf($data);
    }

    public function loadAll(string $sql, array $values): array {
        $data = $this->database->fetchAll($sql, $values);
        return array_map(fn(array $row) => $this->returnOptionalOf($row), $data);
    }

    public function save(Model $obj): void {
        if ($obj->isNew()) {
            $this->_insert($obj);
        } else {
            $this->_update($obj);
        }
    }

    public function delete(Model $obj): void {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $this->database->prepareAndExecute($sql, ['id' => $obj->getId()]);
    }

    private function returnOptionalOf(array|bool $data): ?Model {
        return ($data) ? $this->_create($data) : null;
    }

    abstract protected function _create(array $data = null): mixed;

    abstract protected function _insert(mixed $obj): void;

    abstract protected function _update(mixed $obj): void;
}