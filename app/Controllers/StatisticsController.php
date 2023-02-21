<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Models\User\User;
use NutriScore\Request;
use NutriScore\Services\WeightRecordingService;
use NutriScore\Utils\Session;

class StatisticsController extends AbstractController {
    private const STATISTICS_TEMPLATE = 'statistics/index';

    private WeightRecordingService $weightRecordingService;

    public function __construct(Request $request) {
        parent::__construct($request);

        $this->weightRecordingService = new WeightRecordingService();
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