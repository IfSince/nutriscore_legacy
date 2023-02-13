<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Enums\InputType;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\PersonService;

class PersonController extends AbstractController {
    private const PERSON_DATA_TEMPLATE = 'profile/personal-data';
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

    public function update(): void {
        $this->handleRequest(postFunction: $this->postUpdate(...));
    }

    private function postUpdate(): void {
        $data = $this->request->getInput(InputType::POST);
        $personId = $this->request->getInput(InputType::PAGE)[0];

        $validationObject = $this->personService->updateAndSave($data, $personId);

        if ($validationObject->isValid()) {
            $this->redirectTo("/profile/personal-data");
        } else {
            $this->view->render(
                self::PERSON_DATA_TEMPLATE,
                [
                    'messages' => $validationObject->renderMessages(),
                    'personData' => $validationObject->getData()
                ]
            );
        }

    }
}