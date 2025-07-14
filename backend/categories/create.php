<?php
require_once __DIR__ . '/../../config/config.php';
var_dump($_POST, $_FILES);
die(        );
try {
    $pdo = getDBConnection();
    // Validate form fields (basic example)
    if (empty($_POST['name']) || empty($_POST['slug']) || empty($_POST['description'])) {
        $_SESSION['name'] = 'Please fill in all fields';
        $_SESSION['slug'] = 'Please fill in all fields';
        header('Location: ../../backend.php?folder=categories&page=create');
    }

    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/../../public/uploads/';
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
            throw new Exception('Failed to create upload directory.');
        }

        $image = time() . '_' . basename($_FILES['image']['name']);
        $uploadPath = $uploadDir . $image;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            throw new Exception('Image upload failed.');
        }
    }

    $stmt = $pdo->prepare("INSERT INTO categories (name, slug, description, image, created_at, created_by) VALUES (?, ?, ?, ?, NOW(), 1)");

    $success = $stmt->execute([
        $_POST['name'],
        $_POST['slug'],
        $_POST['description'],
        $image,
    ]);

    if (!$success) {
        throw new Exception('Failed to insert category into the database.');
    }

    // Success: redirect
    header('Location: ../../backend.php?folder=categories&page=index');
    exit;

} catch (Exception $e) {
    // Handle and show the error
    echo '<h3>Error:</h3>';
    echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<a href="javascript:history.back()">Go Back</a>';
    exit;
}
?>
