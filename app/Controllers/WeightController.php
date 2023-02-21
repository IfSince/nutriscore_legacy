<?php

namespace NutriScore\Controllers;

use NutriScore\AbstractController;
use NutriScore\Enums\InputType;
use NutriScore\Enums\MessageType;
use NutriScore\Models\User\User;
use NutriScore\Models\WeightRecording\WeightRecording;
use NutriScore\Request;
use NutriScore\Services\WeightRecordingService;
use NutriScore\Utils\Session;

class WeightController extends AbstractController {
    private const ADD_WEIGHT_TEMPLATE = 'weight/add';

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

    public function add(): void {
        $this->handleRequest(getFunction: $this->getAdd(...), postFunction: $this->postAdd(...));
    }

    public function getAdd(): void {
        $this->view->render(self::ADD_WEIGHT_TEMPLATE);
    }

    public function postAdd(): void {
        $data = $this->request->getInput(InputType::POST);
        $image = $this->request->getInput(InputType::FILE)['image'] ?? null;

        $weightRecording = WeightRecording::create($data);
        $weightRecording->setUserId(Session::get('id'));

        $validationObject = $this->weightRecordingService->saveWithImage($weightRecording, $image, $data['imageDescription']);

        if ($validationObject ->isValid()) {
            Session::flash('success', _('The weight recording was saved successfully'), MessageType::SUCCESS);
            $this->redirectTo('/profile');
        } else {
            Session::flash('error', _('The data contains one or more errors and was not saved.'), MessageType::ERROR);

            $this->view->render(
                self::ADD_WEIGHT_TEMPLATE,
                [
                    'messages' => $validationObject->getMessages(),
                ]
            );
        }
    }
}