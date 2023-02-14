<?php

namespace NutriScore\Models\WeightRecording;

use NutriScore\Models\Model;

class WeightRecording extends Model {
    private ?int $userId = null;
    private int $weight;
    private string $dateOfRecording;
    private ?int $imageId = null;

    public function __construct() {
        $this->dateOfRecording = date('Y-m-d');
    }

    public static function update(WeightRecording $user, array $data = null): void {
        if ($data) {
            WeightRecording::populate($user, $data);
        }
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

    public function setWeight(int|string $weight): void {
        $this->weight = (int) $weight;
    }

    public function getDateOfRecording(): string {
        return $this->dateOfRecording;
    }

    public function setDateOfRecording(string $dateOfRecording): void {
        $this->dateOfRecording = $dateOfRecording;
    }

    public function getImageId(): ?int {
        return $this->imageId;
    }

    public function setImageId(?int $imageId): void {
        $this->imageId = $imageId;
    }


}