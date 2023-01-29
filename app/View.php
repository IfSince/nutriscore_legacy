<?php

namespace NutriScore;

use JetBrains\PhpStorm\NoReturn;
use Nutriscore\Helpers\Session;
use NutriScore\Models\User;

class View {
    private User $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    #[NoReturn]
    public function render(string $view, array $data = []): void {

        $user = $this->user;
        $session = Session::class;

        require_once __DIR__ . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'renders.php';
        require_once __DIR__ . str_replace('/', DIRECTORY_SEPARATOR, "/Views/{$view}.php");
        require_once __DIR__ . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'footer.php';

        exit();
    }
}
