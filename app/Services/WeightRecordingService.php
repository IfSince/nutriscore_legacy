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

    public function save(WeightRecording $weightRecording): WeightRecording {
        $this->weightRecordingDataMapper->save($weightRecording);
        return $weightRecording;
    }

    public function createOrUpdateWeightRecordingByForm(array $data, int $weightRecordingId = null): WeightRecording {
        $weightRecording = $this->weightRecordingDataMapper->findById($weightRecordingId);

        if (isset($weightRecording)) {
            WeightRecording::update($weightRecording, $data);
        } else {
            WeightRecording::create($data);
        }
        return $weightRecording;
    }
}