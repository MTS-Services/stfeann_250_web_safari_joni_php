<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/function.php';

$pdo = getDBConnection(); 
$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("UPDATE products SET status = NOT status WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: /backend.php?folder=products&page=index");
exit;
