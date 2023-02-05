<?php

namespace NutriScore\Controllers;

use http\Header;
use NutriScore\AbstractController;
use NutriScore\InputType;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\ImageService;
use NutriScore\Services\PrivatePersonService;
use NutriScore\Services\UserService;
use NutriScore\Utils\Session;
use function header as headerAlias;

final class ProfileController extends AbstractController {
    private const PROFILE_TEMPLATE = 'profile/index';
    private const ACCOUNT_DATA_TEMPLATE = 'profile/account-data';
    private const PERSONAL_DATA_TEMPLATE = 'profile/personal-data';
    private const NUTRITIONAL_DATA_TEMPLATE = 'profile/nutritional-data';

    private UserService $userService;
    private PrivatePersonService $privatePersonService;
    private ImageService $imageService;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->userService = new UserService();
        $this->privatePersonService = new PrivatePersonService();
        $this->imageService = new ImageService();
    }

    protected function beforeHook(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    protected function handleGetRequest(): void {
        $personData = $this->privatePersonService->findByUserId(Session::get('id'));

        $this->view->render(self::PROFILE_TEMPLATE, ['personData' => $personData]);
    }

    protected function handlePostRequest(): void {
        $file = $this->request->getInput(InputType::FILE);

        $validationObject = $this->imageService->validateAndUpload($file);

        if (empty($validationObject->getErrors())) {
            $userId = (int) Session::get('id');

            $image = $this->imageService->findById($validationObject->getData());
            $this->userService->linkUserToProfileImage($userId, $image);

            header('Location: /profile');
        } else {
            $this->view->render(self::PROFILE_TEMPLATE, ['errors' => $validationObject->getErrors()]);
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