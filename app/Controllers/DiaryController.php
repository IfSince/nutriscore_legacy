<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Enums\InputType;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\DiarySearchService;

final class DiaryController extends AbstractController {
    private const DIARY_TEMPLATE = 'diary/index';
    private const SEARCH_TEMPLATE = 'diary/search';

    private DiarySearchService $diarySearchService;

    public function __construct(Request $request) {
        parent::__construct($request);

        $this->diarySearchService = new DiarySearchService();
    }

    protected function preAuthorize(): void {
        if (!User::isLoggedIn()) {
            $this->redirectTo('/login');
        }
    }

    protected function getRequest(): void {
        $this->view->render(self::DIARY_TEMPLATE);
    }

    public function search(): void {
        $this->handleRequest(getFunction: $this->getSearch(...));
    }

    private function getSearch(): void {
        $data = $this->request->getInput(InputType::GET);
        $queryString = $data['query'] ?? '';

        $result = $this->diarySearchService->findAllByQuery($queryString);

        $this->view->render(self::SEARCH_TEMPLATE, ['searchResults' => $result]);
    }
}