<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Enums\InputType;
use NutriScore\Enums\MessageType;
use NutriScore\Models\MacroDistribution\MacroDistribution;
use NutriScore\Models\Person\Person;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\ChangePasswordService;
use NutriScore\Services\FileService;
use NutriScore\Services\MacroDistributionService;
use NutriScore\Services\NutritionalDataSaveService;
use NutriScore\Services\PersonService;
use NutriScore\Services\UserService;
use NutriScore\Utils\Session;
use NutriScore\View;

final class ProfileController extends AbstractController {
    private const PROFILE_TEMPLATE = 'profile/index';
    private const USER_DATA_TEMPLATE = 'profile/user-data';
    private const PERSONAL_DATA_TEMPLATE = 'profile/personal-data';
    private const NUTRITIONAL_DATA_TEMPLATE = 'profile/nutritional-data';
    private const CHANGE_PASSWORD_DATA_TEMPLATE = 'profile/change-password';

    public function __construct(
        protected Request $request,
        protected View $view,
        private readonly UserService $userService,
        private readonly PersonService $personService,
        private readonly FileService $fileService,
        private readonly ChangePasswordService $changePasswordService,
        private readonly MacroDistributionService $macroDistributionService,
        private readonly NutritionalDataSaveService $nutritionalDataSaveService,
    ) {
        parent::__construct($request, $view);
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
        $user = $this->userService->loadOrThrow($userId);

        $this->view->render(
            self::USER_DATA_TEMPLATE,
            [
                'user' => $user
            ]
        );
    }

    private function postUserData(): void {
        $this->checkCSRF();

        $data = $this->request->getInput(InputType::POST);
        $userId = Session::get('id');

        $user = $this->userService->loadOrThrow($userId);
        User::update($user, $data);

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
        $this->checkCSRF();

        $userId = Session::get('id');
        $data = $this->request->getInput(InputType::POST);

        $person = $this->personService->findByUserId($userId);
        Person::update($person, $data);

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
        $this->handleRequest(
            getFunction: $this->getNutritionalData(...),
            postFunction: $this->postNutritionalData(...)
        );
    }

    private function getNutritionalData(): void {
        $userId = Session::get('id');
        $person = $this->personService->findByUserId($userId);
        $macroDistribution = $person->getNutritionType()->getMacroDistribution() ??
            $this->macroDistributionService->findByUserId($userId);

        $this->view->render(
            self::NUTRITIONAL_DATA_TEMPLATE,
            [
                'person' => $person,
                'macroDistribution' => $macroDistribution ?? null,
            ]
        );
    }

    private function postNutritionalData(): void {
        $this->checkCSRF();

        $userId = Session::get('id');
        $data = $this->request->getInput(InputType::POST);

        $person = $this->personService->findByUserId($userId);
        Person::update($person, $data);

        $macroDistribution = $this->macroDistributionService->findByUserId($userId);
        $macroDistribution = MacroDistribution::createOrUpdate($macroDistribution, $data);

        $validationObject = $this->nutritionalDataSaveService->save($person, $macroDistribution);

        if ($validationObject->isValid()) {
            Session::flash('success-person', _('The changes were saved successfully.'), MessageType::SUCCESS);
            $this->redirectTo('/profile/nutritional-data');
        } else {
            Session::flash(
                'error-person',
                _('The data contains one or more errors and was not saved.'),
                MessageType::ERROR
            );
            $this->view->render(
                self::NUTRITIONAL_DATA_TEMPLATE, [
                    'messages' => $validationObject->getMessages(),
                    'person' => $person,
                    'macroDistribution' => $macroDistribution
                ]
            );
        }
    }

    public function changePassword(): void {
        $this->handleRequest(getFunction: $this->getChangePassword(...), postFunction: $this->postChangePassword(...));
    }

    private function getChangePassword(): void {
        $this->view->render(self::CHANGE_PASSWORD_DATA_TEMPLATE);
    }

    private function postChangePassword(): void {
        $this->checkCSRF();

        $userId = Session::get('id');
        $data = $this->request->getInput(InputType::POST);

        $validationObject = $this->changePasswordService->changePassword($userId, $data);

        if ($validationObject->isValid()) {
            Session::flash('change-success', _('Your password was changed successfully'), MessageType::SUCCESS);
            $this->redirectTo('/profile');
        } else {
            Session::flash(
                'change-error',
                _('The data contains one or more errors and was not saved.'),
                MessageType::ERROR
            );
            $this->view->render(self::CHANGE_PASSWORD_DATA_TEMPLATE, ['messages' => $validationObject->getMessages()]);
        }
    }
}