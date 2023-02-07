<?php

namespace NutriScore\DataMappers;

use NutriScore\DataMapper;
use NutriScore\Models\File\File;
use NutriScore\Models\File\FileType;

class FileMapper extends DataMapper {
    private const RELATED_TABLE = 'files';
    private const RELATED_CLASS = File::class;

    public function __construct() {
        parent::__construct(self::RELATED_TABLE, self::RELATED_CLASS);
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
}