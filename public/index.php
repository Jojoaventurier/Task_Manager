<?php

require_once __DIR__ . '/../app/routes.php';

// Get the current path
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route handling
route($path);