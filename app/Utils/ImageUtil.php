<?php

namespace NutriScore\Utils;

use NutriScore\Models\Image;

class ImageUtil {
    public static function createImageByDatabaseResult(array $data): Image {
        return new Image(
            path: $data['path'],
            text: $data['text'],
            id: $data['image_id'] ?? $data['id'] ?? null,
        );
    }
}