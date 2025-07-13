<?php
require_once __DIR__ . '/../../config/config.php';

$pdo = getDBConnection(); // ✅ FIXED
$errors = [];

// Get values
$name     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$status   = $_POST['status'] ?? '';
$is_admin = $_POST['is_admin'] ?? '0';

// Validation
if ($name === '') $errors[] = "Name is required.";
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Valid email is required.";
} else {
    // ✅ Check if email already exists
    $check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $check->execute([$email]);
    if ($check->fetchColumn() > 0) {
        $errors[] = "This email is already registered.";
    }
}
if ($password === '' || strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
if ($confirm_password === '') $errors[] = "Confirm password is required.";
if ($password !== $confirm_password) $errors[] = "Password and confirm password do not match.";
if (!in_array($status, ['1', '0'])) $errors[] = "Invalid status.";
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

$stmt = $pdo->prepare("INSERT INTO users (name, email, password, status, is_admin) VALUES (?, ?, ?, ?, ?)");
$stmt->bindValue(1, $name);
$stmt->bindValue(2, $email);
$stmt->bindValue(3, $hashedPassword);
$stmt->bindValue(4, $status);
$stmt->bindValue(5, $is_admin);

if ($stmt->execute()) {
    $_SESSION['success'] = "User created successfully.";
    header("Location: /backend.php?folder=user&page=index");
    exit;
} else {
    $_SESSION['errors'] = ["Database error: " . $stmt->errorInfo()[2]];
    header("Location: /backend.php?folder=user&page=create");
    exit;
}
