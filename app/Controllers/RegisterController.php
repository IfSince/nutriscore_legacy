<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Enums\InputType;
use NutriScore\Enums\MessageType;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\RegisterService;
use NutriScore\Services\UserService;
use NutriScore\Utils\Session;

final class RegisterController extends AbstractController {
    private const REGISTER_TEMPLATE = 'register/index';

    private UserService $userService;
    private RegisterService $registerService;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->userService = new UserService();
        $this->registerService = new RegisterService();
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

        $validationObject = $this->registerService->register($formInput);

        if ($validationObject->isValid()) {
            Session::flash('success', 'Your registration was successful. You can log in.', MessageType::SUCCESS);
            $this->redirectTo('/login');
        } else {
            $this->view->render(self::REGISTER_TEMPLATE, ['messages' => $validationObject->renderMessages()]);
        }
    }

}