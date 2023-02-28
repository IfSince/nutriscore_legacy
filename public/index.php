<?php

use NutriScore\App;

session_start();

const AUTO_LOAD_PATH = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
const CONFIG_PATH  = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';

function requireAutoloader(): void {
    if (!file_exists(AUTO_LOAD_PATH)) {
        exit();
    } else {
        require_once AUTO_LOAD_PATH;
    }
}
requireAutoloader();

require_once CONFIG_PATH;

$app = new App();
$app->init();
