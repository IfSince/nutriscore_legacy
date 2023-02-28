<?php

namespace NutriScore\DataMappers;

use NutriScore\Database;
use NutriScore\DataMapper;
use NutriScore\Models\FoodRecording\FoodRecording;

final class FoodRecordingMapper extends DataMapper {
    private const RELATED_TABLE = 'food_recordings';

    public function __construct(
        protected Database $database
    ) {
        parent::__construct(self::RELATED_TABLE, $database);
    }

    protected function _create(array $data = null): FoodRecording {
        return FoodRecording::create($data);
    }

    protected function _insert(mixed $obj): void {
        $sql = 'INSERT INTO food_recordings (user_id, food_id, date_of_recording, time_of_day, amount)
                    VALUES (:userId, :foodId, :dateOfRecording, :timeOfDay, :amount)';
        $params = [
            'userId' => $obj->getUserId(),
            'foodId' => $obj->getFoodId(),
            'dateOfRecording' => $obj->getDateOfRecording(),
            'timeOfDay' => $obj->getTimeOfDay()->value,
            'amount' => $obj->getAmount(),
        ];

        $this->database->prepareAndExecute($sql, $params);
        $obj->setId($this->database->lastInsertId());
    }

    protected function _update(mixed $obj): void {
        $sql = 'UPDATE food_recordings fr
                   SET fr.date_of_recording = :dateOfRecording,
                       fr.time_of_day = :timeOfDay,
                       fr.amount = :amount
                 WHERE fr.id = :id';
        $params = [
            'dateOfRecording' => $obj->getDateOfRecording(),
            'timeOfDay' => $obj->getTimeOfDay(),
            'amount' => $obj->getAmount(),
        ];

        $this->database->prepareAndExecute($sql, $params);
    }

}