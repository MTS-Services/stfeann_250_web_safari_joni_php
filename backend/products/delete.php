<?php
require_once __DIR__ . '/../../config/config.php';

$pdo = getDBConnection();
$id = $_GET['id'] ?? null;
if ($id) {
    $pdo->prepare("DELETE FROM products WHERE id = ?")->execute([$id]);
}
header('Location: ../../backend.php?folder=products&page=index');