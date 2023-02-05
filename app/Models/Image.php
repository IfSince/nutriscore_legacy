<?php

namespace NutriScore\Models;

class Image extends Model {

    public function __construct(
        private string $path,
        private string $text,
        ?string $id = null,
    ) {
        $this->id = (int) $id;
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


}