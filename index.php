<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/function.php';



$page = $_GET['page'] ?? 'home';
$pageTitle = ucfirst($page); // Optional: for title display

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - <?= $pageTitle ?></title>
    <link rel="icon" type="image/x-icon" href="../public/images/logo.PNG">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/public/css/style.css">
</head>

<body>

    <?php 
    if ($page !== 'login' && $page !== 'register') {
        require_once __DIR__ . '/includes/header.php';
    }
    

    
    $pageFile = __DIR__ . "/pages/{$page}.php";
    if (file_exists($pageFile)) {
        require_once $pageFile;
    } else {
        echo "<h2>404 - Page not found</h2>";
    }
    

     if ($page !== 'login' && $page !== 'register') {
        require_once __DIR__ . '/includes/footer.php';

    }?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="/public/js/script.js"></script>
</body>

</html>