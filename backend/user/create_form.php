<?php
require_once __DIR__ . '/../../config/config.php';

$errors = [];

// Get values
$name     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$status   = $_POST['status'] ?? '';
$is_admin = $_POST['is_admin'] ?? '0';

// Validation
if ($name === '') $errors[] = "Name is required.";
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
if ($password === '' || strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
if ($confirm_password === '') $errors[] = "Confirm password is required.";
if ($password !== $confirm_password) $errors[] = "Password and confirm password do not match.";
if (!in_array($status, ['active', 'inactive'])) $errors[] = "Invalid status.";
if (!in_array($is_admin, ['0', '1'])) $errors[] = "Invalid admin status.";

// If errors, redirect back with session data
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = [
        'name' => $name,
        'email' => $email,
        'status' => $status,
        'is_admin' => $is_admin
    ];
    header("Location: /backend.php?folder=user&page=create");
    exit;
}

// Success logic
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$stmt = $conn->prepare("INSERT INTO users (name, email, password, status, is_admin) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $name, $email, $hashedPassword, $status, $is_admin);

if ($stmt->execute()) {
    $_SESSION['success'] = "User created successfully.";
    header("Location: backend.php?folder=user&page=index");
    exit;
} else {
    $_SESSION['errors'] = ["Database error: " . $stmt->error];
    header("Location: backend.php?folder=user&page=create");
    exit;
}
