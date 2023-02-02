<?php

namespace NutriScore;

interface DataMapper {
    public function findAll(): array;
    public function findById(int $id): mixed;
}