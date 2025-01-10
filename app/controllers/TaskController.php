<?php

require_once __DIR__ . '/../database.php';

function listTasks() {
    $db = getDbConnection();
    $tasks = $db->query("SELECT * FROM tasks")->fetchAll();
    require_once __DIR__ . '/../views/tasks.php';
}