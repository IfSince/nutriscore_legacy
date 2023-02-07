<?php

namespace NutriScore\Models;

abstract class Model {
    const NEW_ENTITY_ID = 0;

    protected ?int $id = null;

    public function isNew(): bool {
        return $this->id === self::NEW_ENTITY_ID || $this->id === null;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void {
        $this->id = $id;
    }
}