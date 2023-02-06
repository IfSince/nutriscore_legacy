<?php

namespace NutriScore\Models\File;

use NutriScore\Models\Model;

class File extends Model {
    private FileType $fileType;

    public function __construct(
        private string $path,
        private string $text,
        FileType|string $fileType = FileType::IMAGE,
        ?string $id = null,
    ) {
        $this->id = (int) $id;
        $this->fileType = $this->mapEnumValue(FileType::class, $fileType);
    }

    /**
     * @return string
     */
    public function getPath(): string {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getText(): string {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void {
        $this->text = $text;
    }

    /**
     * @return FileType
     */
    public function getFileType(): FileType {
        return $this->fileType;
    }

    /**
     * @param FileType $fileType
     */
    public function setFileType(FileType $fileType): void {
        $this->fileType = $fileType;
    }


}