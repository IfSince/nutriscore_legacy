<?php

namespace NutriScore\Repositories;

use NutriScore\Database;
use NutriScore\Models\Diary\DiaryRecording;
use NutriScore\Models\Diary\DiaryRecordingType;
use NutriScore\Models\Diary\TimeOfDay;

class DiaryRecordingRepository {
    public function __construct(
        private readonly Database $database
    ) { }

    public function findAllByUserId(int $userId): array {
        $sql = "SELECT fr.id,
                       'food' as type,
                       fr.date_of_recording,
                       fr.time_of_day,
                       fr.amount,
                       f.description as title,
                       f.calories,
                       f.protein,
                       f.carbohydrates,
                       f.fat
                  FROM food_recordings fr
                  JOIN food f ON f.id = fr.food_id
                 WHERE fr.user_id = :userId";
        $params = ['userId' => $userId];

        $data = $this->database->fetchAll($sql, $params);
        return array_map(fn(array $row) => $this->mapDiaryRecording($row), $data);
    }

    private function mapDiaryRecording(array $data): DiaryRecording {
        return new DiaryRecording(
            $data['id'],
            DiaryRecordingType::from($data['type']),
            $data['title'],
            $data['calories'],
            $data['protein'],
            $data['carbohydrates'],
            $data['fat'],
            $data['amount'],
            $data['date_of_recording'],
            TimeOfDay::from($data['time_of_day']),
        );
    }
}