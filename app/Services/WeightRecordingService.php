<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\WeightRecordingMapper;
use NutriScore\Models\WeightRecording\WeightRecording;

class WeightRecordingService {
    private WeightRecordingMapper $weightRecordingDataMapper;

    public function __construct() {
        $this->weightRecordingDataMapper = new WeightRecordingMapper();
    }

    public function findLatestByUserId(int $userId): WeightRecording {
        return $this->weightRecordingDataMapper->findLatestByUserId($userId);
    }

    public function createAndSave(array $data): void {
        $weightRecording = WeightRecording::create($data);
        $this->save($weightRecording);
    }

    public function save(WeightRecording $weightRecording): WeightRecording {
        $this->weightRecordingDataMapper->save($weightRecording);
        return $weightRecording;
    }
}