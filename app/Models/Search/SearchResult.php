<?php

namespace NutriScore\Models\Search;

class SearchResult {

    public function __construct(
        private array $fields = [],
        private array $rows = [],
        private bool $includeHeader = true,
        private bool $clickable = false,
    ) {
    }

    public function addRows(array $rows): void {
        array_push($this->rows, ...$rows);
    }

    public function getRowCount(): int {
        return count($this->rows);
    }

    public function getFields(): array {
        return $this->fields;
    }

    public function setFields(array $fields): void {
        $this->fields = $fields;
    }

    public function getRows(): array {
        return $this->rows;
    }

    public function setRows(array $rows): void {
        $this->rows = $rows;
    }

    public function includeHeader(): bool {
        return $this->includeHeader;
    }

    public function setIncludeHeader(bool $includeHeader): void {
        $this->includeHeader = $includeHeader;
    }

    public function isClickable(): bool {
        return $this->clickable;
    }

    public function setClickable(bool $clickable): void {
        $this->clickable = $clickable;
    }


}