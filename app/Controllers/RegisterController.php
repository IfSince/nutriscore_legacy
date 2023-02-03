<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Services\UserService;

final class RegisterController extends AbstractController {
    private const REGISTER_TEMPLATE = 'register/index';

    private UserService $userService;

    public function __construct() {
        parent::__construct();
        $this->userService = new UserService();
    }

    protected function handleGetRequest(): void {
        $this->view->render(self::REGISTER_TEMPLATE);
    }

    protected function handlePostRequest(): void {
        $formInput = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        $errors = $this->userService->register($formInput);
        if (empty($errors)) {
            header('Location: /login');
        } else {
            $this->view->render(self::REGISTER_TEMPLATE, ['errors' => $errors]);
        }
    }

}