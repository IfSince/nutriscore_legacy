<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Enums\InputType;
use NutriScore\Enums\MessageType;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\UserService;
use NutriScore\Utils\Session;

final class LoginController extends AbstractController {
    private const LOGIN_TEMPLATE = 'login/index';

    private UserService $userService;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->userService = new UserService();
    }

    protected function preAuthorize(): void {
        if (User::isLoggedIn()) {
            $this->redirectTo('/overview');
        }
    }

    protected function getRequest(): void {
        $this->view->render(self::LOGIN_TEMPLATE);
    }

    protected function postRequest(): void {
        $formInput = $this->request->getInput(InputType::POST);

        $validationObject = $this->userService->login($formInput);
        if ($validationObject->isValid()) {
            Session::flash('login', 'You have been successfully signed in.', MessageType::SUCCESS);
            $this->redirectTo('/overview');
        } else {
            $this->view->render(self::LOGIN_TEMPLATE, ['messages' => $validationObject->renderMessages()]);
        }
    }
}
