<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';

$searchQuery = $_POST['search'] ?? '';
header('Location: /?page=search&value=' . urlencode($searchQuery));


