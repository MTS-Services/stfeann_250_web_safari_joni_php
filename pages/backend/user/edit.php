<?php
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/function.php';

$id = $_GET['id'] ?? null;

$data = [
    'name' => '',
    'email' => '',
    'image' => '',
    'password' => '',
    'confirm_password' => '',
    'status' => 1,
    'is_admin' => 0
];

if (!empty($id)) {
    $data = getUser($id);
}
?>

<!-- Error Messages -->
<?php if (!empty($_SESSION['errors'])): ?>
    <div style="color: red; margin-bottom: 10px;">
        <ul>
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Success Message -->
<?php if (!empty($_SESSION['success'])): ?>
    <div style="color: green; margin-bottom: 10px;">
        <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
<?php endif; ?>

<form class="create_form_container" action="../../../backend/user/update_form.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id ?>">
    
    <div class="table-header">
        <h2 class="table-title">Edit User</h2>
        <a href="/backend.php?folder=user&page=index" class="create_button">Back</a>
    </div>

    <div class="main_create_form">
        <div class="create_form_group">
            <label>Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" >
        </div>

        <div class="create_form_group">
            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" >
        </div>

        <div class="create_form_group">
            <label>Current Image</label><br>
            <?php if (!empty($data['image'])): ?>
                <img src="/public/uploads/<?= htmlspecialchars($data['image']) ?>" alt="User Image" width="100">
            <?php else: ?>
                <p>No image uploaded</p>
            <?php endif; ?>
        </div>

        <div class="create_form_group">
            <label>Upload New Image</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <div class="create_form_group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Leave blank to keep unchanged">
        </div>

        <div class="create_form_group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" placeholder="Leave blank to keep unchanged">
        </div>

        <div class="create_form_group">
            <label>Status</label>
            <select name="status">
                <option value="1" <?= $data['status'] == 1 ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= $data['status'] == 0 ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>

        <div class="create_form_group">
            <label>Is Admin</label>
            <select name="is_admin">
                <option value="0" <?= $data['is_admin'] == 0 ? 'selected' : '' ?>>No</option>
                <option value="1" <?= $data['is_admin'] == 1 ? 'selected' : '' ?>>Yes</option>
            </select>
        </div>
    </div>

    <button class="create_submit_btn" type="submit">Update</button>
</form>


<?php
unset($_SESSION['success']);
unset($_SESSION['errors']);
unset($_SESSION['old']);
?>
