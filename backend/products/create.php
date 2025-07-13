<?php
require_once __DIR__ . '/../../config/config.php';

$stmt = $pdo->prepare("INSERT INTO products (name, slug, stock_no, description, price, category_id, sort_order, status, is_featured, created_at, created_by) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 1)");

$stmt->execute([
    $_POST['name'],
    $_POST['slug'],
    $_POST['stock_no'],
    $_POST['description'],
    $_POST['price'],
    $_POST['category_id'],
    $_POST['sort_order'],
    isset($_POST['status']) ? 1 : 0,
    isset($_POST['is_featured']) ? 1 : 0
]);

header('Location: ../../?folder=categories');