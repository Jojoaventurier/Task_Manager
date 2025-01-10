<?php

require_once __DIR__ . '/../helpers.php';

function showData() {
    $data = loadData();
    include __DIR__ . '/../views/data_view.php';
}

function handleDataActions() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';

        if ($action === 'reset') {
            resetData();
        } elseif ($action === 'update') {
            $updatedData = json_decode($_POST['data'], true);
            saveData($updatedData);
        }
    }
    header('Location: /data');
    exit;
}