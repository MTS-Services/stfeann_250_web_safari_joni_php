
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


<form class="create_form_container" action="../../../backend/user/create_form.php" method="POST" enctype="multipart/form-data">
    <div class="table-header">
        <h2 class="table-title">User Create</h2>
        <a href="/backend.php?folder=user&page=index" class="create_button">Back</a>
    </div>
    <div class="main_create_form">
        <div class="create_form_group">
            <label>Name</label>
            <input type="text" name="name">
        </div>

        <div class="create_form_group">
            <label>Email</label>
            <input type="email" name="email">
        </div>
          <div class="create_form_group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
        </div>

        <div class="create_form_group">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="create_form_group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password">
        </div>
    </div>
    <button class="create_submit_btn" type="submit">Create</button>
</form>

<?php
// Clear session flash data
unset($_SESSION['success']);
unset($_SESSION['errors']);
unset($_SESSION['old']);
?>
