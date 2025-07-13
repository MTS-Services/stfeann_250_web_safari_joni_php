<?php
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/function.php';
$data = [
    'name' => '',
    'slug' => '',
    'description' => '',
    'image' => ''
];

if (!empty($id)) {
    $data = getCategory($id);
}
?>
<form class="create_form_container" action="../../../backend/categories/create.php" method="POST">
    <div class="table-header">
        <h2 class="table-title">Category Create</h2>
        <a href="/backend.php?folder=user&page=index" class="create_button">Back</a>
    </div>
    <div class="main_create_form">
        <div class="create_form_group">
            <label for="name">Name</label>
            <input name="name" id="name" value="<?= $data['name'] ?>">
        </div>

        <div class="create_form_group">
            <label for="slug">Slug</label>
            <input name="slug" id="slug" value="<?= $data['slug'] ?>">
        </div>
        <div class="create_form_group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
        </div>
        <div class="create_form_group">
            <label for="description">Description</label>
            <textarea name="description" id="description"><?= $data['description'] ?></textarea>
        </div>
    </div>
    <button class="create_submit_btn" type="submit">Create</button>
</form>