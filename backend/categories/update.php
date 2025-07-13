<?php
require_once __DIR__ . '/../../config/config.php';

try {
    $pdo = getDBConnection();

    if (empty($_POST['name']) || empty($_POST['slug']) || empty($_POST['description'])) {
        $_SESSION['name'] = 'Please fill in all fields';
        $_SESSION['slug'] = 'Please fill in all fields';
        header('Location: ../../backend.php?folder=categories&page=edit&id=' . $_POST['id']);
    }

    $id = $_GET['id'];

    // Get existing image from DB
    $stmt = $pdo->prepare("SELECT image FROM categories WHERE id = ?");
    $stmt->execute([$id]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$existing) {
        throw new Exception("Category with ID $id not found.");
    }

    $image = $existing['image']; // Default to existing image

    // If new image uploaded, replace it
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/../../public/uploads/';
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
            throw new Exception('Failed to create upload directory.');
        }

        $newImageName = time() . '_' . basename($_FILES['image']['name']);
        $uploadPath = $uploadDir . $newImageName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            throw new Exception('Image upload failed.');
        }

        // Optionally delete old image
        if ($image && file_exists($uploadDir . $image)) {
            unlink($uploadDir . $image);
        }

        $image = $newImageName; // Use new image name in update
    }

    // Update query
    $stmt = $pdo->prepare("
        UPDATE categories 
        SET name = ?, slug = ?, description = ?, image = ?, updated_at = NOW(), updated_by = 1 
        WHERE id = ?
    ");

    $success = $stmt->execute([
        $_POST['name'],
        $_POST['slug'],
        $_POST['description'],
        $image,
        $id
    ]);

    if (!$success) {
        throw new Exception('Failed to update category.');
    }

    header('Location: ../../backend.php?folder=categories&page=index');
    exit;
} catch (Exception $e) {
    echo '<h3>Error:</h3>';
    echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<a href="javascript:history.back()">Go Back</a>';
    exit;
}
