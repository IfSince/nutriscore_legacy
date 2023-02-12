<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Enums\InputType;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\FileService;
use NutriScore\Services\PersonService;
use NutriScore\Services\UserService;
use NutriScore\Services\WeightRecordingService;
use NutriScore\Utils\Session;

final class ProfileController extends AbstractController {
    private const PROFILE_TEMPLATE = 'profile/index';
    private const ACCOUNT_DATA_TEMPLATE = 'profile/account-data';
    private const PERSONAL_DATA_TEMPLATE = 'profile/personal-data';
    private const NUTRITIONAL_DATA_TEMPLATE = 'profile/nutritional-data';

    private UserService $userService;
    private PersonService $personService;
    private FileService $fileService;
    private WeightRecordingService $weightRecordingService;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->userService = new UserService();
        $this->personService = new PersonService();
        $this->fileService = new FileService();
        $this->weightRecordingService = new WeightRecordingService();
    }

    protected function beforeHandling(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    protected function handleGetRequest(): void {
        $userId = Session::get('id');

        $user = $this->userService->findById($userId);
        $person = $this->personService->findByUserId($userId);

        $profileImageId = $user->getProfileImageId();
        $profileImage = ($profileImageId != null) ? $this->fileService->findById($profileImageId) : null;

        $currentWeight = $this->weightRecordingService->findByUserId($userId);

        $this->view->render(
            self::PROFILE_TEMPLATE,
            [
                'person' => $person,
                'user' => $user,
                'profileImage' => $profileImage,
                'currentWeight' => $currentWeight
            ]
        );
    }

    protected function handlePostRequest(): void {
        $fileUpload = $this->request->getInput(InputType::FILE);
        $validationObject = $this->fileService->validateAndUpload($fileUpload);

        $userId = Session::get('id');
        if ($validationObject->isValid()) {
            $this->userService->linkUserToProfileImage($userId, $validationObject->getData());
            header('Location: /profile');
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

    public function accountData(): void {
        $this->beforeHandling();
        $this->view->render(self::ACCOUNT_DATA_TEMPLATE);
    }

    public function personalData(): void {
        $this->beforeHandling();
        $this->view->render(self::PERSONAL_DATA_TEMPLATE);
    }

    public function nutritionalData(): void {
        $this->beforeHandling();
        $this->view->render(self::NUTRITIONAL_DATA_TEMPLATE);
    }
}