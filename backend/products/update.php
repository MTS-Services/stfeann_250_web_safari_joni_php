<?php
require_once __DIR__ . '/../../config/config.php';


try {
    $pdo = getDBConnection();

    // Validate presence of product ID
    if (empty($_GET['id'])) {
        $_SESSION['id'] = 'Missing product ID';
        header('Location: ../../backend.php?folder=products&page=edit');
    }

    $id = $_GET['id'];

    // Required fields
    $requiredFields = ['name', 'slug', 'price', 'category_id'];
    foreach ($requiredFields as $field) {
        if(empty($_POST[$field])) {
            $_SESSION[$field] = 'Please fill in all fields';
        }
        if (empty($_POST[$field])) {
            header('Location: ../../backend.php?folder=products&page=edit');
        }
    }

    // Sanitize and assign
    $name        = trim($_POST['name']);
    $slug        = trim($_POST['slug']);
    $stock_no    = trim($_POST['stock_no'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price       = floatval($_POST['price']);
    $category_id = intval($_POST['category_id']);

    // Check that category exists
    $checkCat = $pdo->prepare("SELECT id FROM categories WHERE id = ?");
    $checkCat->execute([$category_id]);
    $_SESSION['category_id'] = 'Category does not exist';
    if (!$checkCat->fetch()) {
        header('Location: ../../backend.php?folder=products&page=edit');
    }

    // Update query
    $stmt = $pdo->prepare("
        UPDATE products SET 
            name = ?, 
            slug = ?, 
            stock_no = ?, 
            description = ?, 
            price = ?, 
            category_id = ?, 
            updated_at = NOW(), 
            updated_by = 1 
        WHERE id = ?
    ");

    $success = $stmt->execute([
        $name,
        $slug,
        $stock_no,
        $description,
        $price,
        $category_id,
        $id
    ]);

    if (!$success) {
        throw new Exception("Failed to update product.");
    }

    header('Location: ../../backend.php?folder=products&page=index');
    exit;

} catch (Exception $e) {
    echo "<h3>Error:</h3>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo '<a href="javascript:history.back()">Go Back</a>';
    exit;
}
