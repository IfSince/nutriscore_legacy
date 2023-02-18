<?php

namespace NutriScore\Models\FoodRecording;

use NutriScore\Models\Diary\TimeOfDay;
use NutriScore\Models\Model;
use NutriScore\Utils\EnumUtil;

class FoodRecording extends Model {
    private int $userId;
    private int $foodId;
    private string $dateOfRecording;
    private TimeOfDay $timeOfDay = TimeOfDay::BREAKFAST;
    private int $amount = 1;

    public function __construct() {
        $this->dateOfRecording = date('Y/m/d');
    }

    public static function update(Model $obj, array $data = null): void {
        if ($data) {
            FoodRecording::populate($obj, $data);
        }
    }

    public static function create(array $data = null): FoodRecording {
        $obj = new FoodRecording();
        if ($data) {
            $obj = FoodRecording::populate($obj, $data);
        }
        return $obj;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }

    public function getFoodId(): int {
        return $this->foodId;
    }

    public function setFoodId(int $foodId): void {
        $this->foodId = $foodId;
    }

    public function getDateOfRecording(): string {
        return $this->dateOfRecording;
    }

    public function setDateOfRecording(string $dateOfRecording): void {
        $this->dateOfRecording = $dateOfRecording;
    }

    public function getTimeOfDay(): TimeOfDay {
        return $this->timeOfDay;
    }

    public function setTimeOfDay(TimeOfDay|string $timeOfDay): void {
        $this->timeOfDay = EnumUtil::mapEnumValue(TimeOfDay::class, $timeOfDay);
    }

    public function getAmount(): int {
        return $this->amount;
    }

    public function setAmount(int $amount): void {
        $this->amount = $amount;
    }


}