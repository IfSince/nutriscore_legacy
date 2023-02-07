<?php

namespace NutriScore\Models\File;

use NutriScore\Models\Model;
use NutriScore\Utils\ArrayUtil;
use NutriScore\Utils\EnumUtil;

class File extends Model {
    private string $path;
    private string $text;
    private FileType $fileType;

    /**
     * @param int|null $id
     * @param string $path
     * @param string $text
     * @param FileType $fileType
     */
    public function __construct(
        ?int     $id,
        string   $path,
        string   $text,
        FileType $fileType
    ) {
        $this->id = $id;
        $this->path = $path;
        $this->text = $text;
        $this->fileType = $fileType;
    }

    public static function from(mixed $data): ?File {
        if ($data) {
            $data = ArrayUtil::snakeCaseToCamelCaseKeys($data);

            return new self(
                $data['id'] ?? null,
                $data['path'],
                $data['text'],
                EnumUtil::mapEnumValue(FileType::class, $data['fileType'])
            );
        } else {
            return null;
        }
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