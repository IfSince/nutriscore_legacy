<?php

namespace NutriScore;

class AbstractController {
    protected const GET_METHOD = 'GET';
    protected const POST_METHOD = 'POST';

    protected View $view;
    protected Request $request;

    public function __construct(Request $request) {
        $this->view = new View();
        $this->request = $request;
    }

    public function index(): void {
        $this->handleRequest($this->getRequest(...), $this->postRequest(...));
    }

    protected function handleRequest(callable $getFunction = null, callable $postFunction = null): void {
        $this->preAuthorize();
        $getFunction = $getFunction ?? $this->methodNotAllowed(...);
        $postFunction = $postFunction ?? $this->methodNotAllowed(...);

        match($this->request->getMethod()) {
            self::GET_METHOD => $getFunction(),
            self::POST_METHOD => $postFunction(),
        };
    }

    protected function methodNotAllowed(): void {
        http_response_code(405);
        echo '405 - Not allowed';
    }

    protected function getRequest(): void {
        $this->methodNotAllowed();
    }

    protected function postRequest(): void {
        $this->methodNotAllowed();
    }

    protected function redirectTo(string $path): void {
        header('Location: ' . $path);
        exit();
    }

    /**
     * Function that can be implemented for logic that should be executed before anything else
     * @return void
     */
    protected function preAuthorize(): void {}
}
