<?php

namespace NutriScore\Models\Diary;

use JsonSerializable;
use NutriScore\Traits\JsonConvertable;

class DiaryRecording implements JsonSerializable {
    use JsonConvertable;

    public int $id;
    public DiaryRecordingType $type = DiaryRecordingType::FOOD;
    public string $title = '';
    public float $calories = 0;
    public float $protein = 0;
    public float $carbohydrates = 0;
    public float $fat = 0;
    public int $amount = 1;
    public string $dateOfRecording;
    public TimeOfDay $timeOfDay = TimeOfDay::BREAKFAST;

    public function __construct(
        int $id,
        DiaryRecordingType $type = DiaryRecordingType::FOOD,
        ?string $title = '',
        ?float $calories = 0,
        ?float $protein = 0,
        ?float $carbohydrates = 0,
        ?float $fat = 0,
        int $amount = 1,
        ?string $dateOfRecording = null,
        TimeOfDay $timeOfDay = TimeOfDay::BREAKFAST
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->title = $title;
        $this->calories = $calories;
        $this->protein = $protein;
        $this->carbohydrates = $carbohydrates;
        $this->fat = $fat;
        $this->amount = $amount;
        $this->dateOfRecording = $dateOfRecording ?? date('Y-m-d');
        $this->timeOfDay = $timeOfDay;
    }
}