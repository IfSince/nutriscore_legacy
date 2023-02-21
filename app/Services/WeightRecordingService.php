<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\WeightRecordingMapper;
use NutriScore\Models\WeightRecording\WeightRecording;

class WeightRecordingService {
    private WeightRecordingMapper $weightRecordingMapper;

    public function __construct() {
        $this->weightRecordingMapper = new WeightRecordingMapper();
    }

    public function findAllByUserId(int $userId): array {
        return $this->weightRecordingMapper->findAllByUserId($userId);
    }

    public function findLatestByUserId(int $userId): WeightRecording {
        return $this->weightRecordingMapper->findLatestByUserId($userId);
    }

    public function save(WeightRecording $weightRecording): WeightRecording {
        $this->weightRecordingMapper->save($weightRecording);
        return $weightRecording;
    }
}