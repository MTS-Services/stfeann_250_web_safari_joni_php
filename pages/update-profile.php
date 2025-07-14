<?php
include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/../config/function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';

    $id = $_POST['id'] ?? null;

    if (!$id) {
        die("User not logged in.");
    }

    $user = getUser($id);
    $image = $user['image']; // Default value

    if (!empty($_FILES['image']['name'])) {
        $filename = time() . '_' . basename($_FILES['image']['name']);
        $image = "uploads/" . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . "/../$image");
    }

    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $email, $image, $id]);

    header("Location: /?page=profile");

}
