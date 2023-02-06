<?php

namespace NutriScore\DataMappers;

use NutriScore\Database;
use NutriScore\DataMapper;
use NutriScore\Models\File\File;
use NutriScore\Models\File\FileType;

class FileMapper implements DataMapper {
    private Database $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function findById(int $id): File {
        $sql = 'SELECT * FROM files WHERE id = :id';
        $result = $this->database->fetch($sql, ['id' => $id]);

        return $this->mapRowToImage($result);
    }

    public function create(string $path, string $text, FileType $fileType): int {
        $sql = 'INSERT INTO files (path, text, file_type)
                    VALUES(:path, :text, :fileType)';
        return $this->database->createAndReturnId($sql, [
            'path' => $path,
            'text' => $text,
            'fileType' => $fileType->value,
        ]);
    }

    private function mapRowToImage(array $data): File {
        return new File(
            path: $data['path'],
            text: $data['text'],
            fileType: $data['file_type'],
            id: $data['id'],
        );
    }
}