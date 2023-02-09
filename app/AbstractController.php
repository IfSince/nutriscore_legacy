<?php

namespace NutriScore;

abstract class AbstractController {
    private const GET_METHOD = 'GET';
    private const POST_METHOD = 'POST';

    protected View $view;
    protected Request $request;

    public function __construct(Request $request) {
        $this->view = new View();
        $this->request = $request;
    }

    public function index(): void {
        $this->beforeHandling();
        match($this->request->getMethod()) {
            self::GET_METHOD => $this->handleGetRequest(),
            self::POST_METHOD => $this->handlePostRequest(),
        };
    }

    protected function handleGetRequest(): void {
        // TODO - Replace dummy error with error message handling
        echo '405 - Not allowed';
    }

    protected function handlePostRequest(): void {
        // TODO - Replace dummy error with error message handling
        echo '405 - Not allowed';
    }

    protected function redirectTo(string $path): void {
        header('Location: ' . $path);
        exit();
    }

    /**
     * Function that can be implemented for logic that should be executed before anything else
     * @return void
     */
    protected function beforeHandling(): void {}
}
