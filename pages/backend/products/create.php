<?php
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/function.php';

$data = [
    'name' => '',
    'slug' => '',
    'stock_no' => '',
    'description' => '',
    'price' => '',
    'category_id' => '',
    'sort_order' => 0,
    'status' => 1,
    'is_featured' => 0
];

if (!empty($id)) {
    $data = getProduct($id);
}
?>
<form action="../actions/<?= empty($id) ? 'create' : 'update' ?>.php" method="POST">
    <?php if ($id): ?><input type="hidden" name="id" value="<?= $id ?>"><?php endif; ?>
    Name: <input name="name" value="<?= $data['name'] ?>"><br>
    Slug: <input name="slug" value="<?= $data['slug'] ?>"><br>
    Stock No: <input name="stock_no" value="<?= $data['stock_no'] ?>"><br>
    Price: <input name="price" value="<?= $data['price'] ?>"><br>
    Description: <textarea name="description"><?= $data['description'] ?></textarea><br>
    Category ID: <input name="category_id" value="<?= $data['category_id'] ?>"><br>
    Sort Order: <input name="sort_order" value="<?= $data['sort_order'] ?>"><br>
    Status: <input type="checkbox" name="status" value="1" <?= $data['status'] ? 'checked' : '' ?>><br>
    Featured: <input type="checkbox" name="is_featured" value="1" <?= $data['is_featured'] ? 'checked' : '' ?>><br>
    <button type="submit">Save</button>
</form>
<form class="create_form_container" action="../../../backend/user/create_form.php" method="POST">
    <div class="table-header">
        <h2 class="table-title">User Create</h2>
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
            <label for="stock_no">Stock No</label>
            <input name="stock_no" id="stock_no" value="<?= $data['stock_no'] ?>">
        </div>

        <div class="create_form_group">
            <label for="price">Price</label>
            <input name="price" id="price" value="<?= $data['price'] ?>">
        </div>

        <div class="create_form_group">
            <label for="description">Description</label>
            <textarea name="description" id="description"><?= $data['description'] ?></textarea>
        </div>

        <div class="create_form_group">
            <label for="category_id">Category ID</label>
            <input name="category_id" id="category_id" value="<?= $data['category_id'] ?>">
        </div>

        <div class="create_form_group">
            <label for="sort_order">Sort Order</label>
            <input name="sort_order" id="sort_order" value="<?= $data['sort_order'] ?>">
        </div>

        <div class="create_form_group">
            <label>
                <input type="checkbox" name="status" value="1" <?= $data['status'] ? 'checked' : '' ?>>
                Status (Active)
            </label>
        </div>
    </div>
    <button class="create_submit_btn" type="submit">Create</button>
</form>