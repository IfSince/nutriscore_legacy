<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Enums\InputType;
use NutriScore\Enums\MessageType;
use NutriScore\Models\Diary\DiaryRecordingType;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\DiaryRecordingService;
use NutriScore\Services\DiarySearchService;
use NutriScore\Services\PersonDTOCreateService;
use NutriScore\Services\PersonService;
use NutriScore\Utils\Session;
use NutriScore\View;

final class DiaryController extends AbstractController {
    private const DIARY_TEMPLATE = 'diary/index';
    private const SEARCH_TEMPLATE = 'diary/search';
    private const ADD_RECORDING_TEMPLATE = 'diary/add';

    public function __construct(
        protected Request                       $request,
        protected View                          $view,
        private readonly DiarySearchService     $diarySearchService,
        private readonly DiaryRecordingService  $diaryRecordingService,
        private readonly PersonService          $personService,
        private readonly PersonDTOCreateService $personDTOCreateService
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
        $recordings = $this->diaryRecordingService->findAllByUserId($userId);
        $personDTO = $this->personDTOCreateService->createPersonDTOByUserId($userId);

        $this->view->render(self::DIARY_TEMPLATE, [
            'diaryRecordings' => $recordings,
            'personDTO' => $personDTO
        ]);
    }

    public function search(): void {
        $this->handleRequest(getFunction: $this->getSearch(...));
    }

    private function getSearch(): void {
        $data = $this->request->getInput(InputType::GET);
        $queryString = $data['query'] ?? '';

        $searchResult = $this->diarySearchService->findAllByQuery($queryString);
        $this->view->render(self::SEARCH_TEMPLATE, ['searchResult' => $searchResult]);
    }

    public function add(): void {
        $this->handleRequest(getFunction: $this->getAdd(...), postFunction: $this->postAdd(...));
    }

    private function getAdd(): void {
        $routeParams = $this->request->getInput(InputType::PAGE_PARAMS);
        $id = $routeParams[1];
        $type = DiaryRecordingType::from($routeParams[0]);

        $diaryRecording = $this->diaryRecordingService->findDiaryRecordingByEntityIdAndType($id, $type);

        $this->view->render(self::ADD_RECORDING_TEMPLATE, ['diaryRecording' => $diaryRecording]);
    }

    private function postAdd(): void {
        $this->checkCSRF();

        $routeParams = $this->request->getInput(InputType::PAGE_PARAMS);
        $data = $this->request->getInput(InputType::POST);
        $id = $routeParams[1];
        $type = DiaryRecordingType::from($routeParams[0]);
        $userId = Session::get('id');

        $this->diaryRecordingService->save($type, $id, $userId, $data);
        Session::flash('add-entry', _('The recording was added successfully.'), MessageType::SUCCESS);
        $this->redirectTo('/diary');
    }
}