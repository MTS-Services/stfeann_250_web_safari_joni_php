<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'stfeen');
define('DB_USER', 'root');
define('DB_PASS', '');
define('APP_NAME', 'Valgrit');
define('BASE_URL', 'http://localhost/valgrit');

function getDBConnection() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// ✅ Define $pdo globally
$pdo = getDBConnection();

// Start session
session_start();

// Security functions
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header('Location: index.php');
        exit();
    }
}

function redirectIfLoggedIn() {
    if (isLoggedIn()) {
        header('Location: pages/backend/dashboard.php');
        exit();
    }
}
