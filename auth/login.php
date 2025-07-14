<?php
require_once __DIR__ . '/../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Please fill in all fields';
        header('Location: ../../?page=login');
        exit();
    }
    
    try {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare("SELECT id, name, email, password, is_admin FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['is_admin'] = $user['is_admin'];

            if ($user['is_admin'] == 1) {
                header('Location: /../backend.php?page=dashboard');
            } else {
                header('Location: ../../?page=profile');
            }
            exit();
        } else {
            $_SESSION['error'] = 'Invalid email or password';
            header('Location: ../../?page=login');
            exit();
        }
    } catch(PDOException $e) {
        $_SESSION['error'] = 'Database error occurred';
        header('Location: ../../?page=login');
        exit();
    }
} else {
    header('Location: ../../?page=home');
    exit();
}
?>
