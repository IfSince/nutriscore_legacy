<?php

function handleRouting(): string {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $route = $_REQUEST['route'] ?? 'login';

        if ($route == 'register') {
            return 'register';
        } else {
            return 'login';
        }
    } else {
        exit();
    }
}

function redirect(string $target, ?string $source = null) : void {
    if (is_null($source)) {
        header( "Location: $target" );
    }
    else {
        header("Location: $target&redirect=$source");
    }
}
