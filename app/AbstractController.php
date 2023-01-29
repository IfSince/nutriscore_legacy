<?php

namespace NutriScore;

use JetBrains\PhpStorm\NoReturn;
use NutriScore\Models\User;

abstract class AbstractController {
    protected Database $db;
    protected User $user;
    protected View $view;

    public function __construct() {

        $this->db = new Database();
        $this->user = new User($this->db);
        $this->view = new View($this->user);
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

    #[NoReturn]
    protected function redirectTo(string $path): void {
        header('Location:' . $path);
        exit();
    }
}
