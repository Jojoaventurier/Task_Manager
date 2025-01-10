<?php

function route($page) {
    switch ($page) {
        case 'home':
            require_once __DIR__ . '/controllers/HomeController.php';
            showHome();
            break;
        case 'tasks':
            require_once __DIR__ . '/controllers/TaskController.php';
            listTasks();
            break;

        case 'data':
            require_once __DIR__ . '/controllers/DataController.php';
            showData();
            break;
        case '/handle-data':
            require_once __DIR__ . '/controllers/DataController.php';
            handleDataActions();
            break;
    
        case 'add-task':
            require_once __DIR__ . '/controllers/DataController.php';
            addTaskHandler();
            break;
        case 'edit-task':
            require_once __DIR__ . '/controllers/DataController.php';
            editTaskHandler();
            break;
        case 'delete-task':
            require_once __DIR__ . '/controllers/DataController.php';
            deleteTaskHandler();
            break;
        default:
            http_response_code(404);
            echo "Page not found.";
    }
}
