<?php
require_once __DIR__ . '/../../config/config.php';

$pdo = getDBConnection(); 
$errors = [];

// Get values
$id       = $_POST['id'] ?? null;
$name     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$image    = $_FILES['image'] ?? null;
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Validate ID
if (!$id || !is_numeric($id)) {
    $_SESSION['errors'] = ["Invalid user ID."];
    header("Location: /backend.php?folder=user&page=index");
    exit;
}

// Validate fields
if ($name === '') $errors[] = "Name is required.";
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Valid email is required.";
} else {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ? AND id != ?");
    $stmt->execute([$email, $id]);
    if ($stmt->fetchColumn() > 0) {
        $errors[] = "Email already in use.";
    }
}
if ($password !== '') {
    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
    if ($password !== $confirm_password) $errors[] = "Passwords do not match.";
}

// If new image uploaded, replace it
if (!empty($_FILES['image']['name'])) {
    $uploadDir = __DIR__ . '/../../public/uploads/';
    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
        throw new Exception('Failed to create upload directory.');
    }

    $newImageName = time() . '_' . basename($_FILES['image']['name']);
    $uploadPath = $uploadDir . $newImageName;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
        throw new Exception('Image upload failed.');
    }

    // Optionally delete old image
    if ($image && file_exists($uploadDir . $image)) {
        unlink($uploadDir . $image);
    }

    $image = $newImageName; // Use new image name in update
}

if ($errors) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = compact('name', 'email');
    header("Location: /backend.php?folder=user&page=edit&id=$id");
    exit;
}

// Prepare query
$query = "UPDATE users SET name = ?, email = ?";
$params = [$name, $email];

// Handle password
if ($password !== '') {
    $query .= ", password = ?";
    $params[] = password_hash($password, PASSWORD_BCRYPT);
}

// Handle image update
if ($image) {
    $query .= ", image = ?";
    $params[] = $image;
}

$query .= " WHERE id = ?";
$params[] = $id;

// Execute update
$stmt = $pdo->prepare($query);
if ($stmt->execute($params)) {
    $_SESSION['success'] = "User updated successfully.";
    header("Location: /backend.php?folder=user&page=index");
} else {
    $_SESSION['errors'] = ["Database error: " . $stmt->errorInfo()[2]];
    header("Location: /backend.php?folder=user&page=edit&id=$id");
}
exit;
