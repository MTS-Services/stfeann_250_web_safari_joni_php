<?php
require_once __DIR__ . '/../../config/config.php';

$pdo = getDBConnection();
$id = $_GET['id'] ?? null;
if ($id) {
    $pdo->prepare("DELETE FROM categories WHERE id = ?")->execute([$id]);
}
header('Location: ../../backend.php?folder=categories&page=index');