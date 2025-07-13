<?php
require_once __DIR__ . '/../../config/config.php';

$pdo = getDBConnection();
$image = '';
if (!empty($_FILES['image']['name'])) {
    $image = time() . '_' . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/$image");
}
$stmt = $pdo->prepare("INSERT INTO categories (name, slug, description, image, created_at, created_by) 
VALUES (?, ?, ?, ?, NOW(), 1)");

$stmt->execute([
    $_POST['name'],
    $_POST['slug'],
    $_POST['description'],
    $image,
]);


header('Location: ../../backend.php?folder=categories&page=index');
