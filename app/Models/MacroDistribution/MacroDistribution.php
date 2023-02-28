<?php

namespace NutriScore\Models\MacroDistribution;

use NutriScore\Models\Model;

class MacroDistribution extends Model {

    public function __construct(
        private ?int $protein = null,
        private ?int $carbohydrates = null,
        private ?int $fat = null,
        private ?int $userId = null,
    ) {
    }

    public static function createOrUpdate(Model $obj = null, array $data = null): MacroDistribution {
        if ($obj) {
            self::update($obj, $data);
            return $obj;
        } else {
            return self::create($data);
        }
    }

    public static function update(Model $obj, array $data = null): void {
        if ($data) {
            MacroDistribution::populate($obj, $data);
        }
    }

    public static function create(array $data = null): MacroDistribution {
        $obj = new MacroDistribution();
        if ($data) {
            $obj = MacroDistribution::populate($obj, $data);
        }
        return $obj;
    }

    public function getProtein(): ?int {
        return $this->protein;
    }

    public function setProtein(int|string|null $protein): void {
        $this->protein = (int)$protein;
    }

    public function getCarbohydrates(): ?int {
        return $this->carbohydrates;
    }

    public function setCarbohydrates(int|string|null $carbohydrates): void {
        $this->carbohydrates = (int)$carbohydrates;
    }

    public function getFat(): ?int {
        return $this->fat;
    }

    public function setFat(int|string|null $fat): void {
        $this->fat = (int)$fat;
    }

    public function getUserId(): ?int {
        return $this->userId;
    }

    public function setUserId(?int $userId): void {
        $this->userId = $userId;
    }


}