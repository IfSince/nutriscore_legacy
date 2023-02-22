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
use NutriScore\Services\PersonService;
use NutriScore\Services\UserService;
use NutriScore\Utils\Session;

final class ProfileController extends AbstractController {
    private const PROFILE_TEMPLATE = 'profile/index';
    private const USER_DATA_TEMPLATE = 'profile/user-data';
    private const PERSONAL_DATA_TEMPLATE = 'profile/personal-data';
    private const NUTRITIONAL_DATA_TEMPLATE = 'profile/nutritional-data';
    private const CHANGE_PASSWORD_DATA_TEMPLATE = 'profile/change-password';

    private UserService $userService;
    private PersonService $personService;
    private FileService $fileService;
    private ChangePasswordService $changePasswordService;
    private MacroDistributionService $macroDistributionService;

    public function __construct(Request $request) {
        parent::__construct($request);

        $this->userService = new UserService();
        $this->personService = new PersonService();
        $this->fileService = new FileService();
        $this->changePasswordService = new ChangePasswordService();
        $this->macroDistributionService = new MacroDistributionService();
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

        $user = $this->userService->findById($userId);
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
        $this->handleRequest(getFunction: $this->getNutritionalData(...), postFunction: $this->postNutritionalData(...));
    }

    private function getNutritionalData(): void {
        $userId = Session::get('id');
        $person = $this->personService->findByUserId($userId);

        if ($person->getNutritionType()->getMacroDistribution() === null) {
            $macroDistribution = $this->macroDistributionService->findByUserId($userId);
        }

        $this->view->render(
            self::NUTRITIONAL_DATA_TEMPLATE,
            [
                'person' => $person,
                'macroDistribution' => $macroDistribution ?? null,
            ]
        );
    }

    private function postNutritionalData(): void {
        $userId = Session::get('id');
        $data = $this->request->getInput(InputType::POST);

        $person = $this->personService->findByUserId($userId);
        Person::update($person, $data);

        $macroDistribution = $this->macroDistributionService->findByUserId($userId);
        $macroDistribution = MacroDistribution::createOrUpdate($macroDistribution, $data);

        $personValidationObject = $this->personService->save($person);

        if ($person->getNutritionType()->getMacroDistribution() === null) {
            // was changed to manual nutrition type and has to be saved in db
            $macroDistribution->setUserId($person->getUserId());
            $this->macroDistributionService->save($macroDistribution);
        } else if (!$macroDistribution->isNew()) {
            // was changed from manual nutrition type and has to be deleted from db
            $this->macroDistributionService->delete($macroDistribution);
            unset($macroDistribution);
        } else {
            unset($macroDistribution);
        }

        if ($personValidationObject->isValid()) {
            Session::flash('success-person', _('The changes were saved successfully.'), MessageType::SUCCESS);
        } else {
            Session::flash('error-person', _('The data contains one or more errors and was not saved.'), MessageType::ERROR);
        }

        $this->view->render(
            self::NUTRITIONAL_DATA_TEMPLATE, [
                'messages' => $personValidationObject->getMessages(),
                'person' => $person,
                'macroDistribution' => $macroDistribution ?? null
            ]
        );


    }

    public function changePassword(): void {
        $this->handleRequest(getFunction: $this->getChangePassword(...), postFunction: $this->postChangePassword(...));
    }

    private function getChangePassword(): void {
        $this->view->render(self::CHANGE_PASSWORD_DATA_TEMPLATE);
    }

    private function postChangePassword(): void {
        $userId = Session::get('id');
        $data = $this->request->getInput(InputType::POST);

        $validationObject = $this->changePasswordService->changePassword($userId, $data);

        if ($validationObject->isValid()) {
            Session::flash('change-success', _('Your password was changed successfully'), MessageType::SUCCESS);
            $this->redirectTo('/profile');
        } else {
            Session::flash('change-error', _('The data contains one or more errors and was not saved.'), MessageType::ERROR);
            $this->view->render(self::CHANGE_PASSWORD_DATA_TEMPLATE, ['messages' => $validationObject->getMessages()]);
        }
    }
}