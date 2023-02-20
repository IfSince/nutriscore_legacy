<?php

namespace NutriScore\Models\Diary;

class DiaryRecording {
    public int $id;
    public DiaryRecordingType $type = DiaryRecordingType::FOOD;
    public string $title = '';
    public float $calories = 0;
    public float $protein = 0;
    public float $carbohydrates = 0;
    public float $fat = 0;

    public function __construct(
        int                $id,
        DiaryRecordingType $type = DiaryRecordingType::FOOD,
        ?string            $title = '',
        ?float             $calories = 0,
        ?float             $protein = 0,
        ?float             $carbohydrates = 0,
        ?float             $fat= 0
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->title = $title;
        $this->calories = $calories;
        $this->protein = $protein;
        $this->carbohydrates = $carbohydrates;
        $this->fat = $fat;
    }


}