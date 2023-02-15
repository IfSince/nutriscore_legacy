<?php

namespace NutriScore\Models\Food;

use NutriScore\Models\Model;

class Food extends Model {
    private string $description;
    private float $calories = 0;
    private float $protein = 0;
    private float $carbohydrates = 0;
    private float $fat = 0;

    public static function update(Model $obj, array $data = null): void {
        if ($data) {
            Food::populate($obj, $data);
        }
    }

    public static function create(array $data = null): Food {
        $obj = new Food();
        if ($data) {
            $obj = Food::populate($obj, $data);
        }
        return $obj;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getCalories(): float {
        return $this->calories;
    }

    public function setCalories(float $calories): void {
        $this->calories = $calories;
    }

    public function getProtein(): float {
        return $this->protein;
    }

    public function setProtein(float $protein): void {
        $this->protein = $protein;
    }

    public function getCarbohydrates(): float {
        return $this->carbohydrates;
    }

    public function setCarbohydrates(float $carbohydrates): void {
        $this->carbohydrates = $carbohydrates;
    }

    public function getFat(): float {
        return $this->fat;
    }

    public function setFat(float $fat): void {
        $this->fat = $fat;
    }

}