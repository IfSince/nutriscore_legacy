<?php

namespace NutriScore\DataMappers;

use NutriScore\DataMapper;
use NutriScore\Models\Food\Food;

class FoodMapper extends DataMapper {
    private const RELATED_TABLE = 'food';

    public function __construct() {
        parent::__construct(self::RELATED_TABLE);
    }

    protected function _create(array $data = null): Food {
        return Food::create($data);
    }

    public function findAllByDescriptionLike(string $description): array {
        $description = "%$description%";
        $sql = "SELECT *
                  FROM food f
                 WHERE lower(f.description) LIKE lower(:description)";
        $params = ['description' => $description];

        return $this->loadAll($sql, $params);
    }

    protected function _insert(mixed $obj): void {
        $sql = 'INSERT INTO food (description, calories, protein, carbohydrates, fat)
                    VALUES (:description, :calories,  :protein, :carboydrates, :fat)';
        $params = [
            'description' => $obj->getDescription(),
            'calories' => $obj->getCalories(),
            'protein' => $obj->getProtein(),
            'carbohydrates' => $obj->getCarbohydrates(),
            'fat' => $obj->getFat(),
        ];

        $this->database->prepareAndExecute($sql, $params);
        $obj->setId($this->database->lastInsertId());
    }

    protected function _update(mixed $obj): void {
        $sql = 'UPDATE food f
                   SET f.description = :description,
                       f.protein = :protein,
                       f.carbohydrates = :carbohydrates,
                       f.fat = :fat
                 WHERE f.id = :id';
        $params = [
            'description' => $obj->getDescription(),
            'calories' => $obj->getCalories(),
            'protein' => $obj->getProtein(),
            'carbohydrates' => $obj->getCarbohydrates(),
            'fat' => $obj->getFat(),
        ];

        $this->database->prepareAndExecute($sql, $params);
    }
}