<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\InputType;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\FileService;
use NutriScore\Services\PrivatePersonService;
use NutriScore\Services\UserService;
use NutriScore\Utils\Session;

final class ProfileController extends AbstractController {
    private const PROFILE_TEMPLATE = 'profile/index';
    private const ACCOUNT_DATA_TEMPLATE = 'profile/account-data';
    private const PERSONAL_DATA_TEMPLATE = 'profile/personal-data';
    private const NUTRITIONAL_DATA_TEMPLATE = 'profile/nutritional-data';

    private UserService $userService;
    private PrivatePersonService $privatePersonService;
    private FileService $imageService;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->userService = new UserService();
        $this->privatePersonService = new PrivatePersonService();
        $this->imageService = new FileService();
    }

    protected function beforeHook(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    protected function handleGetRequest(): void {
        $userId = Session::get('id');

        $personData = $this->privatePersonService->findByUserId($userId);
        $user = $this->userService->findById($userId);

        $profileImageId = $user->getProfileImageId();
        $profileImage = ($profileImageId != null) ? $this->imageService->findById($profileImageId) : null;

        $this->view->render(
            self::PROFILE_TEMPLATE,
            [
                'personData' => $personData,
                'user' => $user,
                'profileImage' => $profileImage
            ]
        );
    }

    protected function handlePostRequest(): void {
        $fileUpload = $this->request->getInput(InputType::FILE);
        $validationObject = $this->imageService->validateAndUpload($fileUpload);

        $userId = Session::get('id');
        if ($validationObject->isValid()) {

            $this->userService->linkUserToProfileImage($userId, $validationObject->getData());

            header('Location: /profile');
        } else {
            $this->view->render(
                self::PROFILE_TEMPLATE,
                [
                    'personData' => $this->privatePersonService->findByUserId($userId),
                    'user' => $this->userService->findById($userId),
                    'errors' => $validationObject->getErrors()
                ]
            );
        }
    }

    public function accountData(): void {
        $this->beforeHook();
        $this->view->render(self::ACCOUNT_DATA_TEMPLATE);
    }

    public function personalData(): void {
        $this->beforeHook();
        $this->view->render(self::PERSONAL_DATA_TEMPLATE);
    }

    public function nutritionalData(): void {
        $this->beforeHook();
        $this->view->render(self::NUTRITIONAL_DATA_TEMPLATE);
    }
}