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
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <link rel="stylesheet" href="/public/css/style.css">
</head>

<body>

<?php include __DIR__ . '/includes/header.php'; ?>

<?php
    $pageFile = __DIR__ . "/pages/{$page}.php";
    if (file_exists($pageFile)) {
        include $pageFile;
    } else {
        echo "<h2>404 - Page not found</h2>";
    }
?>

<?php include __DIR__ . '/includes/footer.php'; ?>

</body>
</html>
