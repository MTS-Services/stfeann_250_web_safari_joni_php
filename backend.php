<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/function.php';


$pdo = getDBConnection();

redirectIfNotLoggedIn();

$page = $_GET['page'] ?? 'dashboard';
$pageTitle = ucfirst($page);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - <?= $pageTitle ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/public/backend/dashboard.css">
</head>

<body>
    <div class="dashboard">
        <!-- Header -->
        <?php include __DIR__ . '/pages/backend/includes/header.php'; ?>

        <!-- Sidebar -->
        <?php include __DIR__ . '/pages/backend/includes/sitebar.php'; ?>

        <!-- Main Content -->
        <main class="main">
            <h1 class="page-title"><?= $pageTitle ?></h1>

            <!-- Stats Cards -->
            <?php
            $pageFile = __DIR__ . "/pages/backend/{$page}.php";
            if (file_exists($pageFile)) {
                include $pageFile;
            } else {
                echo "<h2>404 - Page not found</h2>";
            }
            ?>

            <!-- Recent Orders Table -->
            
        </main>
    </div>

    <!-- Mobile Overlay -->
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <script src="/public/backend/script.js"></script>
</body>

</html>