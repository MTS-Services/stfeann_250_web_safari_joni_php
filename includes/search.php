<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';

$searchQuery = $_POST['search'] ?? '';
var_dump($searchQuery); // Debugging line to check the search input
header('Location: /?page=search&value=' . urlencode($searchQuery));


