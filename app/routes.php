<?php

function route($path) {
    switch ($path) {
        case '/':
            require_once __DIR__ . '/controllers/HomeController.php';
            showHome();
            break;
        case '/data':
            require_once __DIR__ . '/controllers/DataController.php';
            showData();
            break;
        case '/handle-data':
            require_once __DIR__ . '/controllers/DataController.php';
            handleDataActions();
            break;
        default:
            http_response_code(404);
            echo "Page not found.";
    }
}