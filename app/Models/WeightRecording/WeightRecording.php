<?php

namespace NutriScore\Models\WeightRecording;

use NutriScore\Models\Model;

class WeightRecording extends Model {
    private ?int $userId = null;
    private int $weight;
    private string $dateOfRecording;

    public function __construct() {
        $this->dateOfRecording = date('Y-m-d');
    }

    public static function create(array $data = null): WeightRecording {
        $obj = new WeightRecording();
        if ($data) {
            $obj = WeightRecording::populate($obj, $data);
        }
        return $obj;
    }

    public function getUserId(): ?int {
        return $this->userId;
    }

    public function setUserId(?int $userId): void {
        $this->userId = $userId;
    }

    public function getWeight(): int {
        return $this->weight;
    }

    public function setWeight(int $weight): void {
        $this->weight = $weight;
    }

    public function getDateOfRecording(): string {
        return $this->dateOfRecording;
    }

    public function setDateOfRecording(string $dateOfRecording): void {
        $this->dateOfRecording = $dateOfRecording;
    }


}