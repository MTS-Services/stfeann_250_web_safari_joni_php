<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../config/function.php';

$id = $_SESSION['user_id'] ?? null;
if (!$id) {
    die("User not logged in.");
}

$user = getUser($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $image = $user['image']; // Default value

    if (!empty($_FILES['image']['name'])) {
        $filename = time() . '_' . basename($_FILES['image']['name']);
        $image = "uploads/" . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . "/../$image");
    }

    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $email, $image, $id]);

    header("Location: backend.php?page=profile");
    exit;
}
?>

<section>
  <div class="profile-container">
    <h2>Edit Profile</h2>

    <div class="edit-button-wrapper">
      <a href="backend.php?page=profile" class="edit-button">Back</a>
    </div>

    <form method="POST" enctype="multipart/form-data" class="profile-form">
      <label>
        Name:
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
      </label>

      <label>
        Email:
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
      </label>

      <label>
        Profile Image (Optional):
        <input type="file" name="image">
      </label>

      <?php if (!empty($user['image'])): ?>
        <img src="../<?= $user['image'] ?>" width="120" style="margin-top:10px;">
      <?php endif; ?>

      <button type="submit" class="edit-button">Save Changes</button>
    </form>
  </div>
</section>
