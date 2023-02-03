<?php

namespace NutriScore\Models;

interface Model {
    const NEW_ENTITY_ID = 0;

    public function isNew(): bool;
}