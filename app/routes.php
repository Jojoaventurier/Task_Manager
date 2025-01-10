<?php

function route($path) {
    switch ($path) {
        case '/':
            require_once __DIR__ . '/controllers/HomeController.php';
            showHome();
            break;
        case '/tasks':
            require_once __DIR__ . '/controllers/TaskController.php';
            listTasks();
            break;
        default:
            http_response_code(404);
            echo "Page not found.";
    }
}