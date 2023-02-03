<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Utils\Session;
use NutriScore\InputType;
use NutriScore\Models\User;
use NutriScore\Request;
use NutriScore\Services\UserService;

final class LoginController extends AbstractController {
    private const LOGIN_TEMPLATE = 'login/index';

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
        $this->view->render(self::LOGIN_TEMPLATE);
    }

    protected function handlePostRequest(): void {
        $formInput = $this->request->getInput(InputType::POST);

        $errors = $this->userService->login($formInput);
        if (empty($errors)) {
            Session::flash('success', 'You have been successfully signed in.');
            header('Location: /overview');
        } else {
            $this->view->render(self::LOGIN_TEMPLATE, ['errors' => $errors]);
        }
    }
}
