<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

$pdo = getDBConnection();
$errors = [];

// Get values
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$image = $_FILES['image'] ?? null;
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$status = $_POST['status'] ?? '1';
$is_admin = $_POST['is_admin'] ?? '0';

// Validate input
if ($name === '') $errors[] = "Name is required.";
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Valid email is required.";
} else {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn()) $errors[] = "Email already in use.";
}
if ($password === '' || strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
if ($password !== $confirm_password) $errors[] = "Passwords do not match.";
if (!in_array($status, ['0', '1']) || !in_array($is_admin, ['0', '1'])) {
    $errors[] = "Invalid status or admin value.";
}

// On validation error
if ($errors) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = compact('name', 'email', 'status', 'is_admin');
    header("Location: /backend.php?folder=user&page=create");
    exit;
}

// Handle image upload
    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/../../public/uploads/';
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
            throw new Exception('Failed to create upload directory.');
        }

        $image = time() . '_' . basename($_FILES['image']['name']);
        $uploadPath = $uploadDir . $image;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            throw new Exception('Image upload failed.');
        }
    }


if ($errors) {
    $_SESSION['errors'] = $errors;
    header("Location: /backend.php?folder=user&page=create");
    exit;
}

// Insert user
$stmt = $pdo->prepare("INSERT INTO users (name, email, image, password, status, is_admin, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
$success = $stmt->execute([
    $name,
    $email,
    $image,
    password_hash($password, PASSWORD_BCRYPT),
    $status,
    $is_admin
]);

if ($success) {
    $_SESSION['success'] = "User created successfully.";
    header("Location: /backend.php?folder=user&page=index");
} else {
    $_SESSION['errors'] = ["Database error: " . $stmt->errorInfo()[2]];
    header("Location: /backend.php?folder=user&page=create");
}
exit;
