<?php

require_once '../app/db/connection.php';

class Task
{
    /**
     * Fetch all tasks, grouped by general category and category.
     * 
     * @return array
     */
    public static function getAllTasks()
    {
        $pdo = Database::getConnection();
        $query = "
            SELECT 
                tasks.id AS task_id, 
                tasks.name AS task_name, 
                tasks.is_active, 
                categories.name AS category_name, 
                general_categories.name AS general_category_name,
                modes.name AS mode_name
            FROM 
                tasks
            LEFT JOIN 
                categories ON tasks.category_id = categories.id
            LEFT JOIN 
                general_categories ON categories.general_category_id = general_categories.id
            LEFT JOIN 
                modes ON tasks.mode_id = modes.id
            ORDER BY 
                general_categories.name, categories.name, tasks.name;
        ";

        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Add a new task.
     * 
     * @param string $taskName
     * @param int $categoryId
     * @param int|null $modeId
     * @param int $isActive
     * @return void
     */
    public static function addTask($taskName, $categoryId, $modeId, $isActive)
    {
        $pdo = Database::getConnection();
        $query = "INSERT INTO tasks (name, category_id, mode_id, is_active) VALUES (:name, :category_id, :mode_id, :is_active)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':name' => $taskName,
            ':category_id' => $categoryId,
            ':mode_id' => $modeId,
            ':is_active' => $isActive,
        ]);
    }

    /**
     * Update a task's name.
     * 
     * @param int $taskId
     * @param string $newTaskName
     * @return void
     */
    public static function updateTaskName($taskId, $newTaskName)
    {
        $pdo = Database::getConnection();
        $query = "UPDATE tasks SET name = :name WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':name' => $newTaskName,
            ':id' => $taskId,
        ]);
    }

    /**
     * Toggle a task's active status.
     * 
     * @param int $taskId
     * @return void
     */
    public static function toggleActiveStatus($taskId)
    {
        $pdo = Database::getConnection();
        $query = "UPDATE tasks SET is_active = NOT is_active WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':id' => $taskId]);
    }

    /**
     * Delete a task by ID.
     * 
     * @param int $taskId
     * @return void
     */
    public static function deleteTask($taskId)
    {
        $pdo = Database::getConnection();
        $query = "DELETE FROM tasks WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':id' => $taskId]);
    }

    /**
     * Reset the tasks table to its initial state.
     * 
     * @return void
     */
    public static function resetData()
    {
        $pdo = Database::getConnection();
        $pdo->exec("DELETE FROM tasks");
        $pdo->exec("
            INSERT INTO tasks (name, category_id, mode_id, is_active) VALUES
            ('Sample Task 1', 1, 1, 1),
            ('Sample Task 2', 1, NULL, 0),
            ('Sample Task 3', 2, 2, 1);
        ");
    }
}
