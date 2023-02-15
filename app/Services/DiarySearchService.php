<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\FoodMapper;

class DiarySearchService {
    private FoodMapper $foodMapper;

    public function __construct() {
        $this->foodMapper = new FoodMapper();
    }

    public function findAllByQuery(string $query): array {
        if (strlen($query) > 0) {
            return $this->foodMapper->findAllByDescriptionLike($query);
        } else {
            return [];
        }
    }

}