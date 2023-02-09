<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\PersonService;
use NutriScore\Utils\Session;

final class OverviewController extends AbstractController {
    private const OVERVIEW_TEMPLATE = 'overview/index';

    private PersonService $personService;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->personService = new PersonService();
    }

    protected function beforeHook(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    protected function handleGetRequest(): void {
        $personData = $this->personService->findByUserId(Session::get('id'));
        $this->view->render(self::OVERVIEW_TEMPLATE, ['personData' => $personData]);
    }
}