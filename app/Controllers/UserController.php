<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Enums\InputType;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\UserService;
use NutriScore\Utils\Session;

class UserController extends AbstractController {
    private const USER_DATA_TEMPLATE = 'profile/user-data';

    private UserService $userService;

    public function __construct(Request $request) {
        parent::__construct($request);

        $this->userService = new UserService();
    }

    protected function preAuthorize(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    public function logout(): void {
        Session::flash('logout', 'You have been signed out.');
        Session::delete('id');
        $this->redirectTo('/login');
    }

    public function update(): void {
        $this->handleRequest(postFunction: $this->postUpdate(...));
    }

    private function postUpdate(): void {
        $data = $this->request->getInput(InputType::POST);
        $validationObject = $this->userService->update($data);

        if ($validationObject->isValid()) {
            $this->redirectTo("/profile/user-data");
        } else {
            $this->view->render(
                self::USER_DATA_TEMPLATE,
                [
                    'messages' => $validationObject->renderMessages(),
                    'user' => $validationObject->getData()
                ]
            );
        }
    }
}