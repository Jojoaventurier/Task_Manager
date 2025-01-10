<?php

require_once 'db_connection.php';

function showData() {
    // Fetch all data (general categories, categories, and tasks)
    $data = getAllData();
    include 'data_view.php'; // Render the data view with the fetched data
}

// Add task handler
function addTaskHandler() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize and retrieve input values
        $taskName = filter_var($_POST['task_name'], FILTER_SANITIZE_STRING);
        $categoryId = (int) $_POST['category_id'];
        
        if (!empty($taskName) && !empty($categoryId)) {
            addTask($taskName, $categoryId); // Add the task to the database
            header('Location: /data'); // Redirect back to the data page after adding
            exit;
        } else {
            echo "Please provide valid task name and category."; // Error message for invalid input
        }
    }
}

// Edit task handler
function editTaskHandler() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize and retrieve input values
        $taskId = (int) $_POST['task_id'];
        $newTaskName = filter_var($_POST['new_task_name'], FILTER_SANITIZE_STRING);

        if (!empty($newTaskName)) {
            updateTask($taskId, $newTaskName); // Update the task in the database
            header('Location: /data'); // Redirect back to the data page after editing
            exit;
        } else {
            echo "Please provide a valid task name."; // Error message for invalid input
        }
    }
}

// Delete task handler
function deleteTaskHandler() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize and retrieve input value
        $taskId = (int) $_POST['task_id'];
        
        if (!empty($taskId)) {
            deleteTask($taskId); // Delete the task from the database
            header('Location: /data'); // Redirect back to the data page after deleting
            exit;
        } else {
            echo "Invalid task ID."; // Error message for invalid task ID
        }
    }
}