<?php

use JetBrains\PhpStorm\NoReturn;

class View {
    #[NoReturn]
    public function render(string $view, array $data = []): noreturn {
        require_once __DIR__ . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'renders.php';
        require_once __DIR__ . str_replace('/', DIRECTORY_SEPARATOR, "/Views/{$view}.php");
        exit();
    }
}
