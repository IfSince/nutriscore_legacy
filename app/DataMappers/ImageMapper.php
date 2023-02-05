<?php

namespace NutriScore\DataMappers;

use NutriScore\Database;
use NutriScore\DataMapper;
use NutriScore\Models\Image;

class ImageMapper implements DataMapper {
    private Database $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function findAll(): array {
        // TODO: Implement findAll() method.
        return [];
    }

    public function findById(int $id): Image {
        $sql = 'SELECT * FROM images WHERE id = :id';
        $result = $this->database->fetch($sql, ['id' => $id]);

        return new Image(...$result);
    }

    public function create(string $path, string $text): int {
        $sql = 'INSERT INTO images (path, text) VALUES(:path, :text)';
        return $this->database->createAndReturnId($sql, [
            'path' => $path,
            'text' => $text,
        ]);
    }
}