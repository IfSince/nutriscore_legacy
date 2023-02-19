<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Enums\InputType;
use NutriScore\Enums\MessageType;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\UserService;
use NutriScore\Utils\Session;
use NutriScore\Utils\UserUtil;

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
        Session::flash('logout', _('You have been signed out.'));
        Session::delete('id');
        $this->redirectTo('/login');
    }

    public function update(): void {
        $this->handleRequest(postFunction: $this->postUpdate(...));
    }

    private function postUpdate(): void {
        $data = $this->request->getInput(InputType::POST);
        $userId = Session::get('id');

        $user = UserUtil::createOrUpdateByForm($data, $userId);

        $validationObject = $this->userService->save($user);

        if ($validationObject->isValid()) {
            Session::flash('success', _('The changes were saved successfully.'), MessageType::SUCCESS);

            $this->redirectTo("/profile/user-data");
        } else {
            Session::flash('error', _('The data contains one or more errors and was not saved.'), MessageType::ERROR);

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