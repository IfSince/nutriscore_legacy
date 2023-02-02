<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Services\UserService;

final class OverviewController extends AbstractController {
    private const OVERVIEW_TEMPLATE = 'overview/index';

    private UserService $userService;

    public function __construct() {
        parent::__construct();
        $this->userService = new UserService();
    }

    protected function handleGetRequest(): void {
        $id = $_SESSION['id'] ?? 1;
        $user = $this->userService->findById($id);

        $this->view->render(self::OVERVIEW_TEMPLATE, ['user' => $user]);
    }
}