<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\FileMapper;
use NutriScore\Models\File\File;
use NutriScore\Models\File\FileType;
use NutriScore\Validators\FileValidator;
use NutriScore\Validators\ValidationObject;

class FileService {
    private FileMapper $fileMapper;

    public function __construct() {
        $this->fileMapper = new FileMapper();
    }

    public function findById(int $fileId): File {
        return $this->fileMapper->findById($fileId);
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
                $file = $this->fileMapper->create([
                    'path' => $relativePath . DIRECTORY_SEPARATOR . $fileName,
                    'text' => $text,
                    'fileType' => FileType::IMAGE
                ]);

                $this->fileMapper->save($file);

                $imageId = $file->getId();
            }
        }

        return new ValidationObject($imageId ?? null, $validator->getErrors());
    }

    private function createDateCodedPath(): string {
        return str_replace('/', DIRECTORY_SEPARATOR, date('Y/m/d'));
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