<?php

namespace NutriScore;

abstract class AbstractController {
    protected View $view;

    public function __construct() {
        $this->view = new View();
    }

    public function index(): void {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if ($requestMethod === 'GET') {
            $this->handleGetRequest();
        } elseif ($requestMethod === 'POST') {
            $this->handlePostRequest();
        }
    }

    protected function handleGetRequest(): void {
        // TODO - Replace dummy error with error message handling
        echo '405 - Not allowed';
    }

    protected function handlePostRequest(): void {
        // TODO - Replace dummy error with error message handling
        echo '405 - Not allowed';
    }

    protected function redirectTo(string $path): void {
        header('Location:' . $path);
        exit();
    }
}
