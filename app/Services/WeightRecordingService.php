<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\WeightRecordingMapper;
use NutriScore\Models\WeightRecording\WeightRecording;
use NutriScore\Validators\FileValidator;
use NutriScore\Validators\ValidationObject;
use NutriScore\Validators\WeightRecordingValidator;

class WeightRecordingService {

    public function __construct(
        private readonly WeightRecordingMapper $weightRecordingMapper,
        private readonly FileService           $fileService,
        private readonly FileValidator         $fileValidator,
        private readonly WeightRecordingValidator $weightRecordingValidator,
    ) {
    }

    public function findAllByUserId(int $userId): array {
        return $this->weightRecordingMapper->findAllByUserId($userId);
    }

    // TODO Transactions in DB, damit beides nacheinander validiert und gespeichert werden kann. So sehr unschön.
    public function saveWithImage(
        WeightRecording $weightRecording,
        array $imageData = null,
        string $imageDescription = null
    ): ValidationObject {
        if ($imageData['size'] > 0) {
            $fileData = array_merge($imageData, ['text' => $imageDescription]);
            $this->fileValidator->validate($fileData);
        }

        $this->weightRecordingValidator->validate($weightRecording);

        if ($this->fileValidator->isValid() && $this->weightRecordingValidator->isValid()) {

            $file = ($imageData['size'] > 0) ? $this->fileService->save($imageData, $imageDescription)->getData() : null;

            $weightRecording->setImageId($file?->getId());
            $this->weightRecordingMapper->save($weightRecording);
        }
        return new ValidationObject(
            errors: [
                ...$this->fileValidator->getValidationObject()->getErrors(),
                ...$this->weightRecordingValidator->getValidationObject()->getErrors(),
            ],
            warnings: [
                ...$this->fileValidator->getValidationObject()->getWarnings(),
                ...$this->weightRecordingValidator->getValidationObject()->getWarnings(),
            ],
            hints: [
                ...$this->fileValidator->getValidationObject()->getHints(),
                ...$this->weightRecordingValidator->getValidationObject()->getHints(),
            ],
            success: [
                ...$this->fileValidator->getValidationObject()->getSuccess(),
                ...$this->weightRecordingValidator->getValidationObject()->getSuccess(),
            ],
        );
    }
}