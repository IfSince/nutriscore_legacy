<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\PersonService;

class PersonController extends AbstractController {
    private PersonService $personService;

    public function __construct(Request $request) {
        parent::__construct($request);

        $this->personService = new PersonService();
    }

    protected function preAuthorize(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }
}