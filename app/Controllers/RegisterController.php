<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\InputType;
use NutriScore\Request;
use NutriScore\Services\UserService;
use NutriScore\Models\User;

final class RegisterController extends AbstractController {
    private const REGISTER_TEMPLATE = 'register/index';

    private UserService $userService;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->userService = new UserService();
    }

    protected function beforeHook(): void {
        if (User::isLoggedIn()) {
            $this->redirectTo('/overview');
        }
    }

    protected function handleGetRequest(): void {
        if (User::isLoggedIn()) {
            $this->redirectTo('/overview');
        }

        $this->view->render(self::REGISTER_TEMPLATE);
    }

    protected function handlePostRequest(): void {
        $formInput = $this->request->getInput(InputType::POST);

        $errors = $this->userService->register($formInput);
        if (empty($errors)) {
            header('Location: /login');
        } else {
            $this->view->render(self::REGISTER_TEMPLATE, ['errors' => $errors]);
        }
    }

}