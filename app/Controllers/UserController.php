<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Enums\InputType;
use NutriScore\Models\User\User;
use NutriScore\Utils\CSRFToken;
use NutriScore\Utils\Session;

final class UserController extends AbstractController {
    protected function preAuthorize(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    public function logout(): void {
        $this->checkCSRF();
        $this->handleRequest(getFunction: $this->getLogout(...));
    }

    protected function getLogout(): void {
        Session::flash('logout', _('You have been signed out.'));
        Session::delete('id');
        CSRFToken::delete();
        $this->redirectTo('/login');
    }
}