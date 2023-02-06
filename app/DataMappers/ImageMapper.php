<?php

namespace NutriScore\DataMappers;

use NutriScore\Database;
use NutriScore\DataMapper;
use NutriScore\Models\Image\Image;

class ImageMapper implements DataMapper {
    private Database $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function findById(int $id): Image {
        $sql = 'SELECT * FROM images WHERE id = :id';
        $result = $this->database->fetch($sql, ['id' => $id]);

        return $this->mapRowToImage($result);
    }

    public function create(string $path, string $text): int {
        $sql = 'INSERT INTO images (path, text) VALUES(:path, :text)';
        return $this->database->createAndReturnId($sql, [
            'path' => $path,
            'text' => $text,
        ]);
    }

    private function mapRowToImage(array $data): Image {
        return new Image(
            path: $data['path'],
            text: $data['text'],
            id: $data['id']
        );
    }
}