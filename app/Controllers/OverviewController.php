<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\PersonService;
use NutriScore\Utils\Session;
use NutriScore\View;

final class OverviewController extends AbstractController {
    private const OVERVIEW_TEMPLATE = 'overview/index';

    public function __construct(
        protected Request $request,
        protected View $view,
        private readonly PersonService $personService,
    ) {
        parent::__construct($request, $view);
    }

    protected function preAuthorize(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    protected function getRequest(): void {
        $personData = $this->personService->findByUserId(Session::get('id'));
        $this->view->render(self::OVERVIEW_TEMPLATE, ['personData' => $personData]);
    }
}