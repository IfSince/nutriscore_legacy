<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\FileMapper;
use NutriScore\DataMappers\WeightRecordingMapper;
use NutriScore\Models\WeightRecording\WeightRecording;
use NutriScore\Validators\FileValidator;
use NutriScore\Validators\ValidationObject;
use NutriScore\Validators\WeightRecordingValidator;

class WeightRecordingService {
    private WeightRecordingMapper $weightRecordingMapper;
    private FileService $fileService;
    private FileMapper $fileMapper;

    public function __construct() {
        $this->weightRecordingMapper = new WeightRecordingMapper();
        $this->fileService = new FileService();
        $this->fileMapper = new FileMapper();
    }

    public function findAllByUserId(int $userId): array {
        return $this->weightRecordingMapper->findAllByUserId($userId);
    }

    public function findLatestByUserId(int $userId): WeightRecording {
        return $this->weightRecordingMapper->findLatestByUserId($userId);
    }

    // TODO Transactions in DB, damit beides nacheinander validiert und gespeichert werden kann. So sehr unschön.
    public function saveWithImage(
        WeightRecording $weightRecording,
        array $imageData = null,
        string $imageDescription = null
    ): ValidationObject {
        if ($imageData['size'] > 0) {
            $fileData = array_merge($imageData, ['text' => $imageDescription]);
            $fileValidator = new FileValidator($fileData);
            $fileValidator->validate();
        }

        $weightRecordingValidator = new WeightRecordingValidator($weightRecording);
        $weightRecordingValidator->validate();

        if (
            (isset($fileValidator) && $fileValidator->isValid() || !isset($fileValidator)) &&
            $weightRecordingValidator->isValid()
        ) {

            $file = ($imageData['size'] > 0) ? $this->fileService->save($imageData, $imageDescription)->getData() : null;

            $weightRecording->setImageId($file?->getId());
            $this->weightRecordingMapper->save($weightRecording);
        }
        return new ValidationObject(
            errors: [
                ...isset($fileValidator) ? $fileValidator->getValidationObject()->getErrors() : [],
                ...$weightRecordingValidator->getValidationObject()->getErrors(),
            ],
            warnings: [
                ...isset($fileValidator) ? $fileValidator->getValidationObject()->getWarnings() : [],
                ...$weightRecordingValidator->getValidationObject()->getWarnings(),
            ],
            hints: [
                ...isset($fileValidator) ? $fileValidator->getValidationObject()->getHints() : [],
                ...$weightRecordingValidator->getValidationObject()->getHints(),
            ],
            success: [
                ...isset($fileValidator) ? $fileValidator->getValidationObject()->getSuccess() : [],
                ...$weightRecordingValidator->getValidationObject()->getSuccess(),
            ],
        );
    }
}