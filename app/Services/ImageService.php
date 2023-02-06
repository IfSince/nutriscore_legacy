<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\ImageMapper;
use NutriScore\Validators\FileValidator;
use NutriScore\Validators\ValidationObject;

class ImageService {
    private ImageMapper $imageMapper;

    public function __construct() {
        $this->imageMapper = new ImageMapper();
    }

    public function validateAndUpload(?array $file, ?string $text = ''): ValidationObject {
        $image = isset($file['upload']) && $file['upload']['size'] > 0 ? $file['upload'] : null;
        if (!isset($image)) {
            return new ValidationObject(
                null,
                ['errors' => ['file' => 'Failed to read uploaded file']]
            );
        }
        $validator = new FileValidator($image);
        $validator->validate();

        if ($validator->isValid()) {
            $fileName = $this->createUniqueFilename($image['name']);
            $absolutePath = APP_UPLOADS_DIR . DIRECTORY_SEPARATOR . $this->createDateCodedPath();
            $relativePath = str_replace(APP_PUBLIC_DIR , '', $absolutePath);
            $uploadPath = $absolutePath . DIRECTORY_SEPARATOR . $fileName;

            if (!file_exists($absolutePath)) {
                mkdir($absolutePath, 0777, true);
            }

            if (!move_uploaded_file($image['tmp_name'], $uploadPath)) {
                return new ValidationObject(
                    null,
                    ['errors' => ['file' => 'Failed to upload file.']]
                );
            } else {
                $imageId = $this->imageMapper->create($relativePath . DIRECTORY_SEPARATOR . $fileName, $text);
            }
        }

        return new ValidationObject($imageId ?? null, $validator->getErrors());
    }

    private function createDateCodedPath(): string {
        return date('Y/m/d');
    }

    private function createUniqueFilename(string $filename): string {
        $nameParts = explode('.', $filename);
        $namePart = $nameParts[0];

        $fileExt = end($nameParts);
        $time = time();
        $rand = rand(1234, 9876);

        return "{$namePart}-{$time}-{$rand}.{$fileExt}";
    }

}