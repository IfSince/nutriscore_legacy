<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Models\User\User;
use NutriScore\Models\WeightRecording\WeightRecording;
use NutriScore\Request;
use NutriScore\Services\FileService;
use NutriScore\Services\WeightRecordingService;
use NutriScore\Utils\Session;
use NutriScore\View;

final class StatisticsController extends AbstractController {
    private const STATISTICS_TEMPLATE = 'statistics/index';

    public function __construct(
        protected Request                       $request,
        protected View                          $view,
        private readonly WeightRecordingService $weightRecordingService,
        private readonly FileService            $fileService,
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

        $imageIds = array_map(fn(WeightRecording $row) => $row->getImageId(), $weightRecordings);
        $imageIds = array_filter($imageIds); //filter nulls

        $images = $this->fileService->findAllByIds($imageIds);

        $this->view->render(self::STATISTICS_TEMPLATE, [
            'weightRecordings' => $weightRecordings,
            'images' => $images
        ]);
    }

}