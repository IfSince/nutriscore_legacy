<?php

namespace NutriScore\DataMappers;

use NutriScore\Database;
use NutriScore\DataMapper;
use NutriScore\Models\File\File;

class FileMapper extends DataMapper {
    private const RELATED_TABLE = 'files';

    public function __construct(
        protected Database $database
    ) {
        parent::__construct(self::RELATED_TABLE, $database);
    }

    protected function _create(array $data = null): File {
        return File::create($data);
    }

    protected function _insert(mixed $obj): void {
        $sql = 'INSERT INTO files (path, text, file_type)
                    VALUES(:path, :text, :fileType)';
        $params = [
            'path' => $obj->getPath(),
            'text' => $obj->getText(),
            'fileType' => $obj->getFileType()->value,
        ];

        $this->database->prepareAndExecute($sql, $params);
        $obj->setId($this->database->lastInsertId());
    }

    protected function _update(mixed $obj): void {
        $sql = 'UPDATE files f SET f.path = :path, f.text = :text, f.file_type = :fileType WHERE f.id = :id';
        $params = [
            'path' => $obj->getPath(),
            'text' => $obj->getText(),
            'fileType' => $obj->getFileType()->value,
            'id' => $obj->getId()
        ];
        
        $this->database->prepareAndExecute($sql, $params);
    }
}