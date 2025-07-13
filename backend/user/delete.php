<?php
require_once __DIR__ . '/../../config/config.php';

$pdo = getDBConnection(); // ✅ FIXED
$id = $_GET['id'];
$pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
$_SESSION['success'] = "User deleted.";
header("Location: /backend.php?folder=user&page=index");