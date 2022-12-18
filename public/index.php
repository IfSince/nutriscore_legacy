<?php
session_start();

include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
include_once FUNCTIONS_DIRECTORY . 'routing.php';
include_once FUNCTIONS_DIRECTORY . 'registration' . DIRECTORY_SEPARATOR . 'register.php';
include_once FUNCTIONS_DIRECTORY . 'validations' . DIRECTORY_SEPARATOR . 'printMessages.php';
include_once FUNCTIONS_DIRECTORY . 'util' . DIRECTORY_SEPARATOR . 'getPostParam.php';

$route = $_GET[ 'route' ] ?? 'login';
$errors = [];
$isValid = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($route) {
        case 'login':
            // Login
            break;
        case 'register':
            [$errors, $isValid] = validateRegistration();
            if ($isValid) {
                $resultMessage = RegistrationMessages::SUCCESS_MESSAGE;
            } else {
                $resultMessage = RegistrationMessages::ERROR_MESSAGE;
            }
    }
}

include_once TEMPLATES_DIRECTORY . "{$route}.php";
