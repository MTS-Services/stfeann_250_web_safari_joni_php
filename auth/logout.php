<?php
require_once __DIR__ . '/../config/config.php';

// Destroy all session data
session_destroy();

// Redirect to login page
header('Location: ../index.php?page=login');
exit();
?>