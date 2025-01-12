<?php

require_once '../app/model/Task.php';
require_once '../app/model/Category.php';
require_once '../app/model/GeneralCategory.php';
require_once '../app/model/Mode.php';

class TaskController
{
    public function listTasks()
    {
        // Fetch all tasks, grouped by General Category and Category
        $tasks = Task::getAllTasks();
        $categories = Category::getAllCategories();
        $modes = Mode::getAllModes();

        // Load the view and pass data to it
        require_once '../app/views/data_view.php';
    }

    public function addTask($data)
    {
        // Sanitize input
        $taskName = htmlspecialchars($data['task_name']);
        $categoryId = intval($data['category_id']);
        $modeId = !empty($data['mode_id']) ? intval($data['mode_id']) : null;
        $isActive = isset($data['is_active']) ? 1 : 0;

        // Add task to database
        Task::addTask($taskName, $categoryId, $modeId, $isActive);

        // Redirect to the task list
        header('Location: /index.php?action=list_tasks');
        exit;
    }

    public function editTask($data)
    {
        // Sanitize input
        $taskId = intval($data['task_id']);
        $newTaskName = htmlspecialchars($data['new_task_name']);

        // Update task in database
        Task::updateTaskName($taskId, $newTaskName);

        // Redirect to the task list
        header('Location: /index.php?action=list_tasks');
        exit;
    }

    public function toggleTask($data)
    {
        // Sanitize input
        $taskId = intval($data['task_id']);

        // Toggle task's active status
        Task::toggleActiveStatus($taskId);

        // Redirect to the task list
        header('Location: /index.php?action=list_tasks');
        exit;
    }

    public function deleteTask($data)
    {
        // Sanitize input
        $taskId = intval($data['task_id']);

        // Delete task from database
        Task::deleteTask($taskId);

        // Redirect to the task list
        header('Location: /index.php?action=list_tasks');
        exit;
    }

    public function resetData()
    {
        // Reset data to its initial state
        Task::resetData();

        // Redirect to the task list
        header('Location: /index.php?action=list_tasks');
        exit;
    }
}