<?php

namespace NutriScore;

use NutriScore\Enums\InputType;

class Request {
    private array $pageParams;

    public function __construct(array $pageParams) {
        $this->pageParams = $pageParams;
    }

    public function getMethod(): string {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getInput(InputType $inputType): array {
        return match($inputType) {
            InputType::GET => $this->sanitizeInput($_GET),
            InputType::POST => $this->sanitizeInput($_POST),
            InputType::FILE => $_FILES,
            InputType::PAGE_PARAMS => $this->pageParams
        };
    }

    private function sanitizeInput(array $input): array {
        return array_map(function ($element) {
            return htmlspecialchars(trim($element));
        }, $input);
    }


}