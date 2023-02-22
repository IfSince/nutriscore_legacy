<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\WeightRecordingService;
use NutriScore\Utils\Session;
use NutriScore\View;

class StatisticsController extends AbstractController {
    private const STATISTICS_TEMPLATE = 'statistics/index';

    public function __construct(
        protected Request                       $request,
        protected View                          $view,
        private readonly WeightRecordingService $weightRecordingService,
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
        $weightRecordings = $this->weightRecordingService->findAllByUserId($userId);

        $this->view->render(self::STATISTICS_TEMPLATE, ['weightRecordings' => $weightRecordings]);
    }

}