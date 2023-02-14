<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Enums\InputType;
use NutriScore\Enums\MessageType;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\PersonService;
use NutriScore\Utils\PersonUtil;
use NutriScore\Utils\Session;

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

    public function save(): void {
        $this->handleRequest(postFunction: $this->postSave(...));
    }

    private function postSave(): void {
        $data = $this->request->getInput(InputType::POST);
        $personId = $this->request->getInput(InputType::PAGE)[0];

        $person = PersonUtil::createOrUpdateByForm($data, $personId);
        $validationObject = $this->personService->save($person);

        if ($validationObject->isValid()) {
            Session::flash('success', 'The changes were saved successfully. ', MessageType::SUCCESS);

            $this->redirectTo("/profile/personal-data");
        } else {
            Session::flash('error', 'The data contains one or more errors and was not saved.', MessageType::ERROR);

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