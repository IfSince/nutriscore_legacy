<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Database;
use NutriScore\Enums\InputType;
use NutriScore\Enums\MessageType;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\RegisterService;
use NutriScore\Utils\Session;
use NutriScore\View;

final class RegisterController extends AbstractController {
    private const REGISTER_TEMPLATE = 'register/index';

    public function __construct(
        protected Request                $request,
        protected View                   $view,
        private readonly RegisterService $registerService,
        private readonly Database        $database,
    ) {
        parent::__construct($request, $view);
    }

    protected function preAuthorize(): void {
        if (User::isLoggedIn()) {
            $this->redirectTo('/overview');
        }
    }

    protected function getRequest(): void {
        $this->view->render(self::REGISTER_TEMPLATE);
    }

    protected function postRequest(): void {
        $formInput = $this->request->getInput(InputType::POST);

        $validationObject = $this->registerService->register($formInput);

        if ($validationObject->isValid()) {
            Session::flash('success', _('Your registration was successful. You can log in.'), MessageType::SUCCESS);
            $this->redirectTo('/login');
        } else {
            $this->database->rollBack();
            $this->view->render(self::REGISTER_TEMPLATE, ['messages' => $validationObject->getMessages()]);
        }
    }

}