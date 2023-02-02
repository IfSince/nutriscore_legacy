<?php

use NutriScore\App;

session_start();

const AUTO_LOAD_PATH = __DIR__ . '/../vendor/autoload.php';

function requireAutoloader(): void {
    if (!file_exists(AUTO_LOAD_PATH)) {
        exit();
    } else {
        require_once AUTO_LOAD_PATH;
    }
}

requireAutoloader();
$app = new App();
