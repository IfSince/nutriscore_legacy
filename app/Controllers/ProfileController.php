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
use NutriScore\Utils\Session;

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

        $profileImageId = $this->userService->findById($userId)->getProfileImageId();
        $profileImage = ($profileImageId != null) ? $this->fileService->findById($profileImageId) : null;

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
        $existingImageId = $this->userService->findById($userId)->getProfileImageId();

        $validationObject = $this->fileService->save(file: $fileData, existingImageId: $existingImageId);

        if ($validationObject->isValid()) {

            $this->userService->linkUserToProfileImage($userId, $validationObject->getData()->getId());
            Session::flash('profile-success', 'Your profile image was updated successfully.', MessageType::SUCCESS);
            $this->redirectTo('/profile');
        } else {
            Session::flash('profile-error', 'An error occurred when trying to update your profile image.');
            $this->view->render(
                self::PROFILE_TEMPLATE,
                [
                    'personData' => $this->personService->findByUserId($userId),
                    'user' => $this->userService->findById($userId),
                    'messages' => $validationObject->renderMessages()
                ]
            );
        }
    }

    public function userData(): void {
        $this->handleRequest(getFunction: $this->getUserData(...));
    }

    public function personalData(): void {
        $this->handleRequest(getFunction: $this->getPersonalData(...));
    }

    public function nutritionalData(): void {
        $this->handleRequest(getFunction: $this->getNutritionalData(...));
    }

    private function getUserData(): void {
        $userId = Session::get('id');
        $user = $this->userService->findById($userId);
        $profileImageId = $user->getProfileImageId();
        $profileImage = ($profileImageId != null) ? $this->fileService->findById($profileImageId) : null;

        $this->view->render(
            self::USER_DATA_TEMPLATE,
            [
                'user' => $user,
                'profileImage' => $profileImage
            ]
        );
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