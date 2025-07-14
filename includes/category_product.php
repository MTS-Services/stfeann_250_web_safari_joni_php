<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';

$category_id = $_GET['id'] ?? '';

header('Location: /?page=category&category_id=' . urlencode($category_id));
exit;
