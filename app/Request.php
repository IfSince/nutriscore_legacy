<?php

namespace NutriScore;

class Request {
    private array $pageParams;

    public function __construct(array $pageParams) {
        $this->pageParams = $pageParams;
    }

    public function getMethod(): string {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getInput(string $kind = 'post'): array {
        return match($kind) {
            'post' => $this->sanitizeInput($_POST),
            'get' => $this->sanitizeInput($_GET),
            'file' => $_FILES,
            'page' => $this->pageParams
        };
    }

    private function sanitizeInput(array $input): array {
        return array_map(function ($element) {
            return htmlspecialchars(trim($element));
        }, $input);
    }


}