<?php

namespace NutriScore\Models;

class Model {
    const NEW_ENTITY_ID = 0;

    protected int $id;

    public function isNew(): bool {
        return $this->id === self::NEW_ENTITY_ID;
    }

    protected function mapEnumValue(mixed $enumClass, mixed $value): mixed {
        return (gettype($value) === 'string') ? $enumClass::from($value) : $value;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void {
        $this->id = $id;
    }
}