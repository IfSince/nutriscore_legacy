<?php

namespace NutriScore\DataMappers;

use NutriScore\DataMapper;
use NutriScore\Models\WeightRecording\WeightRecording;

class WeightRecordingDataMapper extends DataMapper {
    private const RELATED_TABLE = 'weight_recordings';

    public function __construct() {
        parent::__construct(self::RELATED_TABLE);
    }

    protected function _create(array $data = null): WeightRecording {
        return WeightRecording::create($data);
    }

    protected function _insert(mixed $obj): void {
        $sql = 'INSERT INTO weight_recordings (user_id, weight, date_of_recording)
                    VALUES (:userId, :weight, :dateOfRecording)';
        $params = [
            'userId' => $obj->getUserId(),
            'weight' => $obj->getWeight(),
            'dateOfRecording' => $obj->getDateOfRecording(),
        ];

        $this->database->prepareAndExecute($sql, $params);
        $obj->setId($this->database->lastInsertId());
    }

    protected function _update(mixed $obj): void {
        $sql = 'UPDATE weight_recordings wr
                   SET wr.user_id = :userId,
                       wr.weight = :weight,
                       wr.date_of_recording = :dateOfRecording
                 WHERE wr.id = :id';
        $params = [
            'userId' => $obj->getUserId(),
            'weight' => $obj->getWeight(),
            'dateOfRecording' => $obj->getDateOfRecording()
        ];

        $this->database->prepareAndExecute($sql, $params);
    }
}