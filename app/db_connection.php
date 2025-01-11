<?php

function getDbConnection() {
    $env = parse_ini_file(__DIR__ . '/../.env');
    $dsn = "mysql:host={$env['DB_HOST']};dbname={$env['DB_NAME']};charset=utf8mb4";
    try {
        return new PDO($dsn, $env['DB_USER'], $env['DB_PASSWORD'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

// Fetch all general categories with their associated categories and tasks
function getAllData() {
    $pdo = getDbConnection();
    
    $stmt = $pdo->query('
        SELECT gc.id AS general_category_id, gc.name AS general_category_name,
               c.id AS category_id, c.name AS category_name,
               t.id AS task_id, t.task_name
        FROM general_categories gc
        LEFT JOIN categories c ON gc.id = c.general_category_id
        LEFT JOIN tasks t ON c.id = t.category_id
        ORDER BY gc.id, c.id, t.id
    ');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Add new task
function addTask($taskName, $categoryId) {
    $pdo = getDbConnection();
    
    $stmt = $pdo->prepare('INSERT INTO tasks (task_name, category_id) VALUES (?, ?)');
    $stmt->execute([$taskName, $categoryId]);
}

// Add new category
function addCategory($categoryName, $generalCategoryId) {
    $pdo = getDbConnection();
    
    $stmt = $pdo->prepare('INSERT INTO categories (name, general_category_id) VALUES (?, ?)');
    $stmt->execute([$categoryName, $generalCategoryId]);
}

// Add general category
function addGeneralCategory($categoryName) {
    $pdo = getDbConnection();
    
    $stmt = $pdo->prepare('INSERT INTO general_categories (name) VALUES (?)');
    $stmt->execute([$categoryName]);
}

// Update task
function updateTask($taskId, $newTaskName) {
    $pdo = getDbConnection();
    
    $stmt = $pdo->prepare('UPDATE tasks SET task_name = ? WHERE id = ?');
    $stmt->execute([$newTaskName, $taskId]);
}

// Delete task
function deleteTask($taskId) {
    $pdo = getDbConnection();
    
    $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = ?');
    $stmt->execute([$taskId]);
}