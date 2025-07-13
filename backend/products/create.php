<?php
require_once __DIR__ . '/../../config/config.php';

try {
    $pdo = getDBConnection();

    // Basic validation
    $requiredFields = ['name', 'slug', 'price', 'category_id'];
    $hasError = false;

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $_SESSION[$field] = ucfirst($field) . ' is required.';
            $hasError = true;
        } else {
            unset($_SESSION[$field]);
        }
    }

    if ($hasError) {
        header('Location: ../../backend.php?folder=products&page=create');
        exit;
    }

    // $requiredFields = ['name', 'slug', 'price', 'category_id'];
    // foreach ($requiredFields as $field) {
    //     $_SESSION[$field] = 'Please fill in all fields';
    //     if (empty($_POST[$field])) {
    //         header('Location: ../../backend.php?folder=products&page=create');
    //     }
    // }

    // Sanitize and assign values
    $name = trim($_POST['name']);
    $slug = trim($_POST['slug']);
    $stock_no = trim($_POST['stock_no']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $category_id = intval($_POST['category_id']);

    // Check that category exists
    $checkCat = $pdo->prepare("SELECT id FROM categories WHERE id = ?");
    $checkCat->execute([$category_id]);
    if (!$checkCat->fetch()) {
        $_SESSION['category_id'] = 'Category does not exist';
        header('Location: ../../backend.php?folder=products&page=create');
    }

    // Prepare and execute insert
    $stmt = $pdo->prepare("INSERT INTO products 
        (name, slug, stock_no, description, price, category_id, created_at, created_by) 
        VALUES (?, ?, ?, ?, ?, ?, NOW(), 1)");

    $success = $stmt->execute([
        $name,
        $slug,
        $stock_no,
        $description,
        $price,
        $category_id
    ]);

    if (!$success) {
        $_SESSION['error'] = 'Failed to create product';
        header('Location: ../../backend.php?folder=products&page=create');
    }

    // Redirect to product list
    header('Location: ../../backend.php?folder=products&page=index');
    exit;

} catch (Exception $e) {
    // Output the error (you can replace with session-based flash messages or logging)
    echo "<h3>Error:</h3>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo '<a href="javascript:history.back()">Go Back</a>';
    exit;
}
