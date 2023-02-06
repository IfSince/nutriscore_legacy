<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\PrivatePersonService;
use NutriScore\Utils\Session;

final class OverviewController extends AbstractController {
    private const OVERVIEW_TEMPLATE = 'overview/index';

    private PrivatePersonService $privatePersonService;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->privatePersonService = new PrivatePersonService();
    }

    protected function beforeHook(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    protected function handleGetRequest(): void {
        $personData = $this->privatePersonService->findByUserId(Session::get('id'));
        $this->view->render(self::OVERVIEW_TEMPLATE, ['personData' => $personData]);
    }
}