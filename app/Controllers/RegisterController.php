<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Enums\InputType;
use NutriScore\Enums\MessageType;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\UserService;
use NutriScore\Utils\Session;

final class RegisterController extends AbstractController {
    private const REGISTER_TEMPLATE = 'register/index';

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
        $this->view->render(self::REGISTER_TEMPLATE);
    }

    protected function postRequest(): void {
        $formInput = $this->request->getInput(InputType::POST);

        $validationObject = $this->userService->register($formInput);

        if ($validationObject->isValid()) {
            Session::flash('success', 'Your registration was successful. You can log in.', MessageType::SUCCESS);
            $this->redirectTo('/login');
        } else {
            $this->view->render(self::REGISTER_TEMPLATE, ['messages' => $validationObject->renderMessages()]);
        }
    }

}