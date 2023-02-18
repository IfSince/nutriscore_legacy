<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\FoodMapper;
use NutriScore\DataMappers\FoodRecordingMapper;
use NutriScore\Models\Diary\DiaryRecording;
use NutriScore\Models\Diary\DiaryRecordingType;
use NutriScore\Models\Food\Food;
use NutriScore\Models\FoodRecording\FoodRecording;
use NutriScore\Models\Model;

class DiaryRecordingService {
    private FoodMapper $foodMapper;
    private FoodRecordingMapper $foodRecordingMapper;

    public function __construct() {
        $this->foodMapper = new FoodMapper();
        $this->foodRecordingMapper = new FoodRecordingMapper();
    }

    public function loadDiaryRecordingByEntityIdAndType(int $id, DiaryRecordingType $type): DiaryRecording {
        $data = match ($type) {
            DiaryRecordingType::FOOD => $this->foodMapper->findById($id)
        };

        return $this->mapDiaryRecordings($data);
    }

    public function save(DiaryRecordingType $type, int $id, int $userId, array $data): void {
        match ($type) {
            DiaryRecordingType::FOOD => $this->saveFoodRecording($id, $userId, $data)
        };
    }

    private function mapDiaryRecordings(Model $model): DiaryRecording {
        if ($model instanceof Food) {
            return new DiaryRecording(
                $model->getId(),
                DiaryRecordingType::FOOD,
                $model->getDescription(),
                null,
                $model->getCalories(),
                $model->getProtein(),
                $model->getCarbohydrates(),
                $model->getFat()
            );
        } else {
            //this should never be the case
            return new DiaryRecording(-1);
        }
    }

    private function saveFoodRecording(int $id, int $userId, array $data): void {
        $data['userId'] = $userId;
        $data['foodId'] = $id;

        $foodRecording = FoodRecording::create($data);
        $this->foodRecordingMapper->save($foodRecording);
    }
}