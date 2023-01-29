<?php

use JetBrains\PhpStorm\NoReturn;

class View {

    #[NoReturn]
    public function render(string $view, array $data = []): void {
        require_once __DIR__ . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'renders.php';
        require_once __DIR__ . str_replace('/', DIRECTORY_SEPARATOR, "/Views/{$view}.php");
        require_once __DIR__ . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'footer.php';
        exit();
    }
}
