<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\WeightRecordingDataMapper;
use NutriScore\Models\WeightRecording\WeightRecording;

class WeightRecordingService {
    private WeightRecordingDataMapper $weightRecordingDataMapper;

    public function __construct() {
        $this->weightRecordingDataMapper = new WeightRecordingDataMapper();
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