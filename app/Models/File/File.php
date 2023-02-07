<?php

namespace NutriScore\Models\File;

use NutriScore\Models\Model;
use NutriScore\Utils\EnumUtil;

class File extends Model {
    private string $path;
    private string $text;
    private FileType $fileType;

    public function getPath(): string {
        return $this->path;
    }

    public function setPath(string $path): void {
        $this->path = $path;
    }

    public function getText(): string {
        return $this->text;
    }

    public function setText(string $text): void {
        $this->text = $text;
    }

    public function getFileType(): FileType {
        return $this->fileType;
    }

    public function setFileType(FileType|string $fileType): void {
        $this->fileType = EnumUtil::mapEnumValue(FileType::class, $fileType);
    }


}