<?php
require_once __DIR__ . '/../../config/config.php';

try {
    $pdo = getDBConnection();
    $pdo->beginTransaction();

    // Basic validation
    $requiredFields = ['name', 'slug', 'price', 'category_id', 'stock_no'];
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

    // Sanitize values
    $name = trim($_POST['name']);
    $slug = trim($_POST['slug']);
    $stock_no = trim($_POST['stock_no']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $category_id = intval($_POST['category_id']);

    // Verify category exists
    $stmt = $pdo->prepare("SELECT id FROM categories WHERE id = ?");
    $stmt->execute([$category_id]);
    if (!$stmt->fetch()) {
        $_SESSION['category_id'] = 'Invalid category';
        header('Location: ../../backend.php?folder=products&page=create');
        exit;
    }

    // Insert product
    $stmt = $pdo->prepare("INSERT INTO products (name, slug, stock_no, description, price, category_id, created_at, created_by)
                           VALUES (?, ?, ?, ?, ?, ?, NOW(), 1)");
    $stmt->execute([$name, $slug, $stock_no, $description, $price, $category_id]);

    // Get inserted product ID
    $product_id = $pdo->lastInsertId();

    // Handle images
    $errors = [];
    $uploaded_count = 0;
    $upload_dir = __DIR__ . "/../../public/uploads/products/";

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (!empty($_FILES['images']['name']) && is_array($_FILES['images']['name'])) {
        foreach ($_FILES['images']['name'] as $key => $imgName) {
            if ($_FILES['images']['error'][$key] !== UPLOAD_ERR_OK)
                continue;

            $tmp_name = $_FILES['images']['tmp_name'][$key];
            $new_file = time() . '_' . basename($imgName);
            $destination = $upload_dir . $new_file;

            if (move_uploaded_file($tmp_name, $destination)) {
                $sort_order = $uploaded_count;
                $is_primary = $key === 0 ? 1 : 0;

                $stmt = $pdo->prepare("INSERT INTO product_images (product_id, image, sort_order, is_primary, created_at, created_by)
                                       VALUES (?, ?, ?, ?, NOW(), 1)");
                if ($stmt->execute([$product_id, $new_file, $sort_order, $is_primary])) {
                    $uploaded_count++;
                } else {
                    $errors[] = "Image DB insert failed: $imgName";
                    unlink($destination);
                }
            } else {
                $errors[] = "Failed to upload: $imgName";
            }
        }
    }

    $pdo->commit();

    if (!empty($errors)) {
        $_SESSION['image_errors'] = $errors;
    }

    header('Location: ../../backend.php?folder=products&page=index');
    exit;
} catch (Exception $e) {
    $pdo->rollBack();
    echo "<h3>Something went wrong!</h3>";
    echo "<p>" . $e->getMessage() . "</p>";
    exit;
}
