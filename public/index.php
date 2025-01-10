<?php

require_once __DIR__ . '/../app/routes.php';

// Default to 'home' if no page is specified
$page = $_GET['page'] ?? 'home';

// Route based on the page parameter
route($page);