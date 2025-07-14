<?php
require_once __DIR__ . '/../../config/config.php';

try {
    $pdo = getDBConnection();
    $pdo->beginTransaction();

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
        header('Location: ../../backend.php?folder=products&page=edit&id=' . $_GET['id'] ?? '');
        exit;
    }


    // Get POST data
    $id = intval($_GET['id']);
    $name = trim($_POST['name']);
    $slug = trim($_POST['slug']);
    $stock_no = trim($_POST['stock_no'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = floatval($_POST['price']);
    $category_id = intval($_POST['category_id']);
    $is_primary_set = isset($_POST['is_primary']) ? 1 : 0;

    // Check if product exists
    $stmt = $pdo->prepare("SELECT id FROM products WHERE id = ?");
    $stmt->execute([$id]);
    if (!$stmt->fetch()) {
        $_SESSION['error'] = 'Product not found.';
        header('Location: ../../backend.php?folder=products&page=index');
        exit;
    }

    // Check if category exists
    $stmt = $pdo->prepare("SELECT id FROM categories WHERE id = ?");
    $stmt->execute([$category_id]);
    if (!$stmt->fetch()) {
        $_SESSION['category_id'] = 'Invalid category';
        header('Location: ../../backend.php?folder=products&page=edit&id=' . $id);
        exit;
    }

    // Update product
    $stmt = $pdo->prepare("UPDATE products 
        SET name = ?, slug = ?, stock_no = ?, description = ?, price = ?, category_id = ?, updated_at = NOW(), updated_by = 1 
        WHERE id = ?");
    $stmt->execute([$name, $slug, $stock_no, $description, $price, $category_id, $id]);

    // Upload image logic
    $errors = [];
    $uploaded_count = 0;
    $upload_dir = __DIR__ . "/../../uploads/products/";

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // OPTIONAL: Delete existing images
    if (!empty($_FILES['images']['name']) && is_array($_FILES['images']['name'])) {
        // Step 1: Delete old image files
        $oldImages = $pdo->prepare("SELECT image FROM product_images WHERE product_id = ?");
        $new_images_uploaded = !empty($_FILES['images']['name']) &&
            is_array($_FILES['images']['name']) &&
            array_filter($_FILES['images']['name']);
            
        $oldImages->execute([$id]);
        if ($new_images_uploaded) {
            foreach ($oldImages->fetchAll() as $img) {
                $oldPath = $upload_dir . $img['image'];
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
        }

        // Step 2: Delete from DB
        if($new_images_uploaded) {
            $pdo->prepare("DELETE FROM product_images WHERE product_id = ?")->execute([$id]);
        }

        // Step 3: Insert new images
        foreach ($_FILES['images']['name'] as $key => $imgName) {
            if ($_FILES['images']['error'][$key] !== UPLOAD_ERR_OK) continue;

            $tmp_name = $_FILES['images']['tmp_name'][$key];
            $new_file = time() . '_' . basename($imgName);
            $destination = $upload_dir . $new_file;

            if (move_uploaded_file($tmp_name, $destination)) {
                $sort_order = $uploaded_count;
                $is_primary = ($uploaded_count === 0 && $is_primary_set) ? 1 : 0;

                $stmt = $pdo->prepare("INSERT INTO product_images 
                    (product_id, image, sort_order, is_primary, created_at, created_by) 
                    VALUES (?, ?, ?, ?, NOW(), 1)");
                if ($stmt->execute([$id, $new_file, $sort_order, $is_primary])) {
                    $uploaded_count++;
                } else {
                    $errors[] = "DB insert failed: $imgName";
                    unlink($destination);
                }
            } else {
                $errors[] = "Upload failed: $imgName";
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
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    exit;
}