<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\FileMapper;
use NutriScore\DataMappers\UserMapper;
use NutriScore\Models\File\File;
use NutriScore\Models\File\FileType;
use NutriScore\Validators\FileValidator;
use NutriScore\Validators\ValidationObject;

class FileService {
    private FileMapper $fileMapper;
    private UserMapper $userMapper;

    public function __construct() {
        $this->fileMapper = new FileMapper();
        $this->userMapper = new UserMapper();
    }

    public function findProfileImageByUserId(int $userId): ?File {
        $profileImageId = $this->userMapper->findById($userId)->getProfileImageId();
        return ($profileImageId != null) ? $this->fileMapper->findById($profileImageId) : null;
    }

    public function findById(int $fileId): File {
        return $this->fileMapper->findById($fileId);
    }

    public function save(?array $file, ?string $text = 'Uploaded File', int $existingImageId = null): ValidationObject {
        $fileData = array_merge($file, ['text' => $text]);
        $validator = new FileValidator($fileData);
        $validator->validate();

        if ($validator->isValid()) {
            $fileName = $this->createUniqueFilename($fileData['name']);
            $absolutePath = APP_UPLOADS_DIR . DIRECTORY_SEPARATOR . $this->createDateCodedPath();
            $relativePath = str_replace(APP_PUBLIC_DIR , '', $absolutePath);
            $uploadPath = $absolutePath . DIRECTORY_SEPARATOR . $fileName;

            if (!file_exists($absolutePath)) {
                mkdir($absolutePath, 0777, true);
            }

            if (!move_uploaded_file($fileData['tmp_name'], $uploadPath)) {
                $validator->getValidationObject()->addError('file', _('Failed to upload file'));
            } else {
                $data = [
                    'path' => $relativePath . DIRECTORY_SEPARATOR . $fileName,
                    'text' => $text,
                    'fileType' => FileType::IMAGE
                ];

                if ($existingImageId) {
                    $file = $this->findById($existingImageId);
                    $this->fileMapper->delete($file);
                    $this->deleteFile($file);
                }

                $file = File::create($data);
                $this->fileMapper->save($file);

                $validator->getValidationObject()->setData($file);
            }

        }

        return $validator->getValidationObject();
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

    private function deleteFile(File $file): void {
        $absolutePath = APP_ROOT_DIR . $file->getPath();

        if (file_exists($absolutePath)) {
            unlink($absolutePath);
        }
    }

}