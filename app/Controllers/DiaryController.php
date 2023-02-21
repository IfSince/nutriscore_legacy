<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Enums\InputType;
use NutriScore\Models\Diary\DiaryRecordingType;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\DiaryRecordingService;
use NutriScore\Services\DiarySearchService;
use NutriScore\Utils\Session;

final class DiaryController extends AbstractController {
    private const DIARY_TEMPLATE = 'diary/index';
    private const SEARCH_TEMPLATE = 'diary/search';
    private const ADD_RECORDING_TEMPLATE = 'diary/add';

    private DiarySearchService $diarySearchService;
    private DiaryRecordingService $diaryRecordingService;

    public function __construct(Request $request) {
        parent::__construct($request);

        $this->diarySearchService = new DiarySearchService();
        $this->diaryRecordingService = new DiaryRecordingService();
    }

    protected function preAuthorize(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    protected function getRequest(): void {
        $userId = Session::get('id');
        $recordings = $this->diaryRecordingService->findAllByUserId($userId);

        $this->view->render(self::DIARY_TEMPLATE, ['diaryRecordings' => $recordings]);
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
        $routeParams = $this->request->getInput(InputType::PAGE);
        $id = $routeParams[1];
        $type = DiaryRecordingType::from($routeParams[0]);

        $diaryRecording = $this->diaryRecordingService->findDiaryRecordingByEntityIdAndType($id, $type);


        $this->view->render(self::ADD_RECORDING_TEMPLATE, ['diaryRecording' => $diaryRecording]);
    }

    private function postAdd(): void {
        $routeParams = $this->request->getInput(InputType::PAGE);
        $data = $this->request->getInput(InputType::POST);
        $id = $routeParams[1];
        $type = DiaryRecordingType::from($routeParams[0]);
        $userId =  Session::get('id');

        $this->diaryRecordingService->save($type, $id, $userId, $data);
        $this->redirectTo('/diary');
    }
}