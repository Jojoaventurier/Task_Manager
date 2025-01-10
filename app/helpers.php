<?php

function loadData() {
    // Load from session or fallback to initial state
    if (isset($_SESSION['data'])) {
        return $_SESSION['data'];
    }
    return require __DIR__ . '/data.php';
}

function saveData($data) {
    $_SESSION['data'] = $data;
}

function resetData() {
    unset($_SESSION['data']);
}