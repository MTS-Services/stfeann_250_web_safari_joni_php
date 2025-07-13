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
$status   = $_POST['status'] ?? '';
$is_admin = $_POST['is_admin'] ?? '0';

// Validate ID
if (empty($id) || !is_numeric($id)) {
    $_SESSION['errors'] = ["Invalid user ID."];
    header("Location: /backend.php?folder=user&page=index");
    exit;
}

// Validation
if ($name === '') $errors[] = "Name is required.";

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Valid email is required.";
} else {
    // Check if email already exists for other users
    $check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ? AND id != ?");
    $check->execute([$email, $id]);
    if ($check->fetchColumn() > 0) {
        $errors[] = "This email is already taken by another user.";
    }
}

if ($image && $image['error'] !== UPLOAD_ERR_NO_FILE && $image['error'] !== UPLOAD_ERR_OK) {
    $errors[] = "Image upload failed.";
}

if ($password !== '') {
    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
    if ($confirm_password === '') $errors[] = "Confirm password is required.";
    if ($password !== $confirm_password) $errors[] = "Passwords do not match.";
}

if (!in_array($status, ['1', '0'])) $errors[] = "Invalid status.";
if (!in_array($is_admin, ['0', '1'])) $errors[] = "Invalid admin status.";

// Redirect if any error
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = [
        'name' => $name,
        'email' => $email,
        'status' => $status,
        'is_admin' => $is_admin
    ];
    header("Location: /backend.php?folder=user&page=edit&id=" . $id);
    exit;
}

// Build update query
$query = "UPDATE users SET name = ?, email = ?, status = ?, is_admin = ?";
$params = [$name, $email, $status, $is_admin];

// If password updated
if ($password !== '') {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $query .= ", password = ?";
    $params[] = $hashedPassword;
}

// If image uploaded
if ($image && $image['error'] === UPLOAD_ERR_OK) {
    $imageName = $image['name']; // You can enhance this with `uniqid()` and upload logic
    $query .= ", image = ?";
    $params[] = $imageName;
}

// Add WHERE clause
$query .= " WHERE id = ?";
$params[] = $id;

// Prepare & execute
$stmt = $pdo->prepare($query);
if ($stmt->execute($params)) {
    $_SESSION['success'] = "User updated successfully.";
    header("Location: /backend.php?folder=user&page=index");
    exit;
} else {
    $_SESSION['errors'] = ["Database error: " . $stmt->errorInfo()[2]];
    header("Location: /backend.php?folder=user&page=edit&id=" . $id);
    exit;
}
