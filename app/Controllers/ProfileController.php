<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Enums\InputType;
use NutriScore\Enums\MessageType;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\FileService;
use NutriScore\Services\PersonService;
use NutriScore\Services\UserService;
use NutriScore\Utils\PersonUtil;
use NutriScore\Utils\Session;
use NutriScore\Utils\UserUtil;

final class ProfileController extends AbstractController {
    private const PROFILE_TEMPLATE = 'profile/index';
    private const USER_DATA_TEMPLATE = 'profile/user-data';
    private const PERSONAL_DATA_TEMPLATE = 'profile/personal-data';
    private const NUTRITIONAL_DATA_TEMPLATE = 'profile/nutritional-data';

    private UserService $userService;
    private PersonService $personService;
    private FileService $fileService;

    public function __construct(Request $request) {
        parent::__construct($request);

        $this->userService = new UserService();
        $this->personService = new PersonService();
        $this->fileService = new FileService();
    }

    protected function preAuthorize(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    protected function getRequest(): void {
        $userId = Session::get('id');

        $person = $this->personService->findByUserId($userId);
        $profileImage = $this->fileService->findProfileImageByUserId($userId);

        $this->view->render(
            self::PROFILE_TEMPLATE,
            [
                'person' => $person,
                'profileImage' => $profileImage,
            ]
        );
    }

    protected function postRequest(): void {
        $fileData = $this->request->getInput(InputType::FILE)['upload'] ?? null;
        $userId = Session::get('id');

        $existingImage = $this->fileService->findProfileImageByUserId($userId);

        $validationObject = $this->fileService->save(file: $fileData, existingImageId: $existingImage?->getId());

        if ($validationObject->isValid()) {

            $this->userService->linkUserToProfileImage($userId, $validationObject->getData()->getId());
            Session::flash('profile-success', _('Your profile image was updated successfully.'), MessageType::SUCCESS);
            $this->redirectTo('/profile');
        } else {
            $this->view->render(
                self::PROFILE_TEMPLATE,
                [
                    'person' => $this->personService->findByUserId($userId),
                    'profileImage' => $existingImage,
                    'messages' => $validationObject->getMessages()
                ]
            );
        }
    }

    public function userData(): void {
        $this->handleRequest(getFunction: $this->getUserData(...), postFunction: $this->postUserData(...));
    }

    private function getUserData(): void {
        $userId = Session::get('id');
        $user = $this->userService->findById($userId);

        $this->view->render(
            self::USER_DATA_TEMPLATE,
            [
                'user' => $user
            ]
        );
    }

    private function postUserData(): void {
        $data = $this->request->getInput(InputType::POST);
        $userId = Session::get('id');

        $user = UserUtil::createOrUpdateByForm($data, $userId);

        $validationObject = $this->userService->save($user);

        if ($validationObject->isValid()) {
            Session::flash('success', _('The changes were saved successfully'), MessageType::SUCCESS);
        } else {
            Session::flash('error', _('The data contains one or more errors and was not saved.'), MessageType::ERROR);
        }

        $this->view->render(
            self::USER_DATA_TEMPLATE,
            [
                'messages' => $validationObject->getMessages(),
                'user' => $user
            ]
        );
    }

    public function personalData(): void {
        $this->handleRequest(getFunction: $this->getPersonalData(...), postFunction: $this->postPersonalData(...));
    }

    private function getPersonalData(): void {
        $userId = Session::get('id');
        $person = $this->personService->findByUserId($userId);

        $this->view->render(
            self::PERSONAL_DATA_TEMPLATE,
            [
                'person' => $person,
            ]
        );
    }

    private function postPersonalData(): void {
        $userId = Session::get('id');
        $data = $this->request->getInput(InputType::POST);
        $personId = $this->personService->findByUserId($userId)->getId();

        $person = PersonUtil::createOrUpdateByForm($data, $personId);
        $validationObject = $this->personService->save($person);

        if ($validationObject->isValid()) {
            Session::flash('success', _('The changes were saved successfully.'), MessageType::SUCCESS);
        } else {
            Session::flash('error', _('The data contains one or more errors and was not saved.'), MessageType::ERROR);
        }

        $this->view->render(
            self::PERSONAL_DATA_TEMPLATE,
            [
                'messages' => $validationObject->getMessages(),
                'person' => $validationObject->getData()
            ]
        );
    }

    public function nutritionalData(): void {
        $this->handleRequest(getFunction: $this->getNutritionalData(...));
    }

    private function getNutritionalData(): void {
        $userId = Session::get('id');
        $person = $this->personService->findByUserId($userId);

        $this->view->render(
            self::NUTRITIONAL_DATA_TEMPLATE,
            [
                'person' => $person,
            ]
        );
    }
}