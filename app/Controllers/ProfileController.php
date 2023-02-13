<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Enums\InputType;
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

    protected function handleGetRequest(): void {
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

    protected function handlePostRequest(): void {
        $fileUpload = $this->request->getInput(InputType::FILE);
        $validationObject = $this->fileService->validateAndUpload($fileUpload);

        $userId = Session::get('id');
        if ($validationObject->isValid()) {
            $this->userService->linkUserToProfileImage($userId, $validationObject->getData());
            $this->redirectTo('/profile');
        } else {
            $this->view->render(
                self::PROFILE_TEMPLATE,
                [
                    'personData' => $this->personService->findByUserId($userId),
                    'user' => $this->userService->findById($userId),
                    'errors' => $validationObject->getErrors()
                ]
            );
        }
    }

    public function userData(): void {
        $this->preAuthorize();
        if ($this->request->getMethod() === self::GET_METHOD) {
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

        } else if ($this->request->getMethod() === self::POST_METHOD) {
            exit();
        }
    }

    public function personalData(): void {
        $this->preAuthorize();
        $this->view->render(self::PERSONAL_DATA_TEMPLATE);
    }

    public function nutritionalData(): void {
        $this->preAuthorize();
        $this->view->render(self::NUTRITIONAL_DATA_TEMPLATE);
    }
}