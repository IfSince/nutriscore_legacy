<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\WeightRecordingMapper;
use NutriScore\Models\WeightRecording\WeightRecording;
use NutriScore\Validators\ValidationObject;
use NutriScore\Validators\WeightRecordingValidator;

class WeightRecordingService {

    public function __construct(
        private readonly WeightRecordingMapper    $weightRecordingMapper,
        private readonly FileService              $fileService,
        private readonly WeightRecordingValidator $weightRecordingValidator,
    ) {
    }

    public function findAllByUserId(int $userId): array {
        return $this->weightRecordingMapper->findAllByUserId($userId);
    }

    public function saveWithImage(
        WeightRecording $weightRecording,
        array           $imageData = null,
        string          $imageDescription = null
    ): ValidationObject {
        $fileValidation = (isset($imageData['size']) && $imageData['size'] > 0) ? $this->fileService->save($imageData, $imageDescription) : null;

        $weightRecording->setImageId($fileValidation?->getData()->getId());
        $weightRecordingValidation = $this->save($weightRecording);

        return new ValidationObject(
            errors: [
                ...$fileValidation?->getErrors() ?? [],
                ...$weightRecordingValidation->getErrors(),
            ],
            warnings: [
                ...$fileValidation?->getWarnings() ?? [],
                ...$weightRecordingValidation->getWarnings(),
            ],
            hints: [
                ...$fileValidation?->getHints() ?? [],
                ...$weightRecordingValidation->getHints(),
            ],
            success: [
                ...$fileValidation?->getSuccess() ?? [],
                ...$weightRecordingValidation->getSuccess(),
            ],
        );
    }

    public function save(WeightRecording $weightRecording): ValidationObject {
        $this->weightRecordingValidator->validate($weightRecording);
        if ($this->weightRecordingValidator->isValid()) {
            $this->weightRecordingMapper->save($weightRecording);
        }
        return $this->weightRecordingValidator->getValidationObject();
    }
}