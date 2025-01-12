<?php
// public/index.php

// Autoload required files
require_once '../app/db/connection.php';
require_once '../app/controller/TaskController.php';
require_once '../app/model/GeneralCategory.php';
require_once '../app/model/Category.php';
require_once '../app/model/Task.php';
require_once '../app/model/Mode.php';

// Create an instance of the TaskController
$taskController = new TaskController();

// Handle routes and actions
$action = $_GET['action'] ?? 'list_tasks';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($action) {
        case 'add_task':
            $taskController->addTask($_POST);
            break;
        case 'edit_task':
            $taskController->editTask($_POST);
            break;
        case 'toggle_task':
            $taskController->toggleTask($_POST);
            break;
        case 'delete_task':
            $taskController->deleteTask($_POST);
            break;
        case 'reset_data':
            $taskController->resetData();
            break;
        default:
            http_response_code(404);
            echo "Invalid action.";
    }
} else {
    // GET requests
    switch ($action) {
        case 'list_tasks':
            $taskController->listTasks();
            break;
        case 'view_task':
            $taskController->viewTask($_GET);
            break;
        default:
            http_response_code(404);
            echo "Page not found.";
    }
}