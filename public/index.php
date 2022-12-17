<?php

session_start();

//Some Constants
include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';

include_once FUNCTIONS_DIRECTORY . 'routing.php';


//$route = $_GET[ 'route' ] ?? 'login';
//
//if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//
//    switch ($route) {
//        case 'register':
//            redirect('?route=register', 'login');
//            break;
//        default:
//            break;
//    }
//
//    $templateFile = TEMPLATES_DIRECTORY . "{$route}.php";
//
//    if (file_exists($templateFile)) {
//        include_once $templateFile;
//    } else {
//        echo 'Gewünschter Pfad nicht vorhanden 404';
//    }
//}



$route = $_GET[ 'route' ] ?? 'login';
$errors = [];

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
    switch( $route ){
        case 'login':

            break;
        case 'register':
            redirect( '?route=login', 'redirect' );
            break;
    }
}

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'GET' ) {
    switch( $route ){
        case 'logout':
            redirect( '?route=login', 'logout' );
            break;
        case 'feed':
            break;
    }
}

/** @var string $template_file */
$template_file = TEMPLATES_DIRECTORY . "{$route}.php";

if ( file_exists( $template_file ) ) {
    include_once $template_file;
}
else {
    echo 'Page not found 404';
}
