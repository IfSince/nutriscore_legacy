<?php

namespace NutriScore\DataMappers;

use NutriScore\DataMapper;
use NutriScore\Models\File\File;
use NutriScore\Utils\ArrayUtil;

class FileMapper extends DataMapper {
    private const RELATED_TABLE = 'files';
    private const RELATED_CLASS = File::class;

    public function __construct() {
        parent::__construct(self::RELATED_TABLE, self::RELATED_CLASS);
    }

    protected function _create(): File {
        return new File();
    }

    protected function _insert(mixed $obj) {
        $sql = 'INSERT INTO files (path, text, file_type)
                    VALUES(:path, :text, :fileType)';
        $this->database->queryStatement(
            $sql,
            [
                'path' => $obj->getPath(),
                'text' => $obj->getText(),
                'fileType' => $obj->getFileType()->value,
            ]
        );

        $obj->setId($this->database->lastInsertId());
    }

    protected function _update(mixed $obj) {
        $sql = 'UPDATE files f SET f.path = :path, f.text = :text, f.file_type = :fileType WHERE f.id = :id';
        $this->database->queryStatement(
            $sql,
            [
                'path' => $obj->getPath(),
                'text' => $obj->getText(),
                'fileType' => $obj->getFileType()->value,
                'id' => $obj->getId()
            ]
        );
    }

    protected function _delete(mixed $obj) {
        $sql = 'DELETE FROM files f WHERE f.id = :id';
        $this->database->queryStatement(
            $sql,
            [
                'id' => $obj->getId()
            ]
        );
    }

    public function populate(mixed $obj, array $data): File {
        ArrayUtil::snakeCaseToCamelCaseKeys($data);

        if (isset($data['id'])) {
            $obj->setId($data['id']);
        }
        if (isset($data['path'])) {
            $obj->setPath($data['path']);
        }
        if (isset($data['text'])) {
            $obj->setText($data['text']);
        }
        if (isset($data['fileType'])) {
            $obj->setFileType($data['fileType']);
        }

        return $obj;
    }
}