<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Models\User\User;
use NutriScore\Utils\Session;

class UserController extends AbstractController {
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
}