<?php
// Ensure you have a database connection in db.php
require_once __DIR__ . '../../../config/config.php';

$pdo = getDBConnection();
// var_dump( $_FILES['images']['name']);
// die();

// Check if files were uploaded and if it's an array (for multiple uploads)
if (!empty($_FILES['images']['name']) && is_array($_FILES['images']['name'])) {
    $product_id = $_POST['product_id'] ?? null; // Get product_id from POST
    $sort_order_base = $_POST['sort_order'] ?? 0; // Get base sort order
    $is_primary_set = isset($_POST['is_primary']) ? 1 : 0; // Check if primary is set

    // Ensure product_id is valid before proceeding
    if ($product_id === null) {
        // Handle error: product_id is missing
        error_log("Error: product_id is missing for multiple image upload.");
        header("Location: ../public/error.php?message=Product ID is missing.");
        exit();
    }

    $uploaded_count = 0;
    $errors = [];

    // Loop through each uploaded file
    foreach ($_FILES['images']['name'] as $key => $name) {
        // Check for upload errors for the current file
        if ($_FILES['images']['error'][$key] !== UPLOAD_ERR_OK) {
            $errors[] = "File '$name' upload error: " . $_FILES['images']['error'][$key];
            continue; // Skip to the next file
        }

        $tmp_name = $_FILES['images']['tmp_name'][$key];
        $file_name = time() . '_' . basename($name); // Sanitize filename
        $upload_dir = "../uploads/"; // Define your upload directory

        // Create the uploads directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create recursively with full permissions
        }

        $target_file = $upload_dir . $file_name;

        // Move the uploaded file
        if (move_uploaded_file($tmp_name, $target_file)) {
            // Prepare and execute the SQL statement for each image
            // We'll increment the sort_order for each image, making the first one primary if set
            $sort_order = $sort_order_base + $uploaded_count;
            $is_current_primary = ($uploaded_count === 0 && $is_primary_set) ? 1 : 0; // Only first uploaded can be primary if checkbox was checked

            $stmt = $pdo->prepare("INSERT INTO product_images (product_id, image, sort_order, is_primary, created_at, created_by)
                               VALUES (?, ?, ?, ?, NOW(), ?)");

            if ($stmt->execute([
                $product_id,
                $file_name,
                $sort_order,
                $is_current_primary,
                1 // created_by (assumed admin ID or user ID)
            ])) {
                $uploaded_count++;
            } else {
                $errors[] = "Database insert failed for file: $name";
                // Optionally delete the file if DB insert fails
                unlink($target_file);
            }
        } else {
            $errors[] = "Failed to move uploaded file: $name";
        }
    }

    if (!empty($errors)) {
        // Log errors or display them to the user
        error_log("Multiple image upload errors: " . implode(", ", $errors));
        // Redirect to an error page or show a message
        header("Location: /backend.php?folder=products&page=images");
    } else {
        header("Location: /backend.php?page=dashboard");
    }
    exit();
} else if (!empty($_FILES['images']['name']) && !is_array($_FILES['images']['name'])) {
    // This block handles a single file upload if 'images' was not an array (e.g., if 'multiple' attribute was missing)
    // You might want to remove this block if you strictly enforce multiple uploads.
    error_log("Warning: Single file uploaded to a multiple upload handler. Consider adding 'multiple' attribute to input.");

    $product_id = $_POST['product_id'] ?? null;
    $sort_order = $_POST['sort_order'] ?? 0;
    $is_primary = isset($_POST['is_primary']) ? 1 : 0;

    if ($product_id === null) {
        error_log("Error: product_id is missing for single image upload.");
        header("Location: ../public/error.php?message=Product ID is missing.");
        exit();
    }

    $image_name = time() . '_' . basename($_FILES['images']['name']);
    $upload_dir = "../uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $target_file = $upload_dir . $image_name;

    if (move_uploaded_file($_FILES['images']['tmp_name'], $target_file)) {
        $stmt = $pdo->prepare("INSERT INTO product_images (product_id, image, sort_order, is_primary, created_at, created_by)
                               VALUES (?, ?, ?, ?, NOW(), ?)");
        if ($stmt->execute([
            $product_id,
            $image_name,
            $sort_order,
            $is_primary,
            1
        ])) {
            header("Location: /backend.php?page=dashboard");
        } else {
            error_log("Database insert failed for single file: " . $_FILES['images']['name']);
            unlink($target_file);
            header("Location: /backend.php?folder=products&page=images");
        }
    } else {
        error_log("Failed to move single uploaded file: " . $_FILES['images']['name']);
        header("Location: ../public/product_images.php?product_id={$product_id}&status=error&message=" . urlencode("Failed to move uploaded file."));
    }
    exit();
} else {
    // No files were uploaded or an empty submission
    header("Location: ../public/product_images.php?product_id={$product_id}&status=error&message=" . urlencode("No files were uploaded."));
    exit();
}
