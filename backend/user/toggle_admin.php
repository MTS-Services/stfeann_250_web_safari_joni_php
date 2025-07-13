<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/function.php';

$pdo = getDBConnection(); 
$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("UPDATE users SET is_admin = NOT is_admin WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: /backend.php?folder=user&page=index");
exit;