<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\UserService;
use NutriScore\Utils\Session;

final class OverviewController extends AbstractController {
    private const OVERVIEW_TEMPLATE = 'overview/index';

    private UserService $userService;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->userService = new UserService();
    }

    protected function beforeHook(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    protected function handleGetRequest(): void {
        $id = Session::get('id');
//        Session::delete('id');

        $user = $this->userService->findById($id);

        $this->view->render(self::OVERVIEW_TEMPLATE, ['user' => $user]);
    }
}