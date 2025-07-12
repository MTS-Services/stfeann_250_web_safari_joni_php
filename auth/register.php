<?php
require_once __DIR__ . '/../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    
    // Validation
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = 'Please fill in all fields';
        header('Location: ../index.php');
        exit();
    }
    
    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match';
        header('Location: ../index.php');
        exit();
    }
    
    if (strlen($password) < 6) {
        $_SESSION['error'] = 'Password must be at least 6 characters long';
        header('Location: ../index.php');
        exit();
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email format';
        header('Location: ../index.php');
        exit();
    }
    
    try {
        $pdo = getDBConnection();
        
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->fetch()) {
            $_SESSION['error'] = 'Email already exists';
            header('Location: ../index.php');
            exit();
        }
        
        // Hash password and insert user
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, NOW())");
        
        if ($stmt->execute([$name, $email, $hashed_password])) {
            $_SESSION['success'] = 'Registration successful! Please login.';
            header('Location: ../index.php');
            exit();
        } else {
            $_SESSION['error'] = 'Registration failed';
            header('Location: ../index.php');
            exit();
        }
    } catch(PDOException $e) {
        $_SESSION['error'] = 'Database error occurred';
        header('Location: /../pages/login.php');
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}
?>