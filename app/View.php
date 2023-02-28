<?php

namespace NutriScore;

final class View {
    public function render(string $view, array $data = [], int $statusCode = 200): void {
        extract($data);

        require_once __DIR__ . str_replace('/', DIRECTORY_SEPARATOR, "/Views/helpers/renders.php");
        require_once __DIR__ . str_replace('/', DIRECTORY_SEPARATOR, "/Views/$view.php");
        require_once __DIR__ . str_replace('/', DIRECTORY_SEPARATOR, "/Views/partials/footer.php");

        http_response_code($statusCode);
        exit();
    }
}
