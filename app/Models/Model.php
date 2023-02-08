<?php

namespace NutriScore\Models;

abstract class Model {
    private const NEW_ENTITY_ID = 0;

    protected ?int $id = null;

    public function isNew(): bool {
        return $this->id === self::NEW_ENTITY_ID || $this->id === null;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }
}