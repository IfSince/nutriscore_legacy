<?php

namespace NutriScore;

interface DataMapper {
    public function findById(int $id): mixed;
}