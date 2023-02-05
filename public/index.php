<?php

use NutriScore\App;

session_start();

const APP_ROOT_DIR = __DIR__;
const APP_PUBLIC_DIR = APP_ROOT_DIR . DIRECTORY_SEPARATOR;
const APP_UPLOADS_DIR = APP_PUBLIC_DIR . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images';

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
