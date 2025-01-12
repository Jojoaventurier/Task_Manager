<?php
// app/controllers/TaskController.php
require_once '../db/connection.php';
require_once '../model/Task.php';

class TaskController
{
    public function listTasks(): void
    {
        global $pdo;
        $tasks = Task::getAll($pdo);
        include '../views/data_view.php';
    }

    public function addTask(array $postData): void
    {
        global $pdo;
        $stmt = $pdo->prepare("
            INSERT INTO tasks (name, category_id, mode_id, is_active)
            VALUES (:name, :category_id, :mode_id, :is_active)
        ");
        $stmt->execute([
            ':name' => $postData['task_name'],
            ':category_id' => $postData['category_id'],
            ':mode_id' => $postData['mode_id'] ?? null,
            ':is_active' => isset($postData['is_active']) ? 1 : 0,
        ]);
        header('Location: /');
    }
}