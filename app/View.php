<?php

namespace NutriScore;

class View {

    public function render(string $view, array $data = [], int $statusCode = 200): void {
        extract($data);

        require_once __DIR__ . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'renders.php';
        require_once __DIR__ . str_replace('/', DIRECTORY_SEPARATOR, "/Views/$view.php");
        require_once __DIR__ . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'footer.php';

        http_response_code($statusCode);
        exit();
    }
}
