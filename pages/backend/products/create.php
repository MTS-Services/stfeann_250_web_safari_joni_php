<?php
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/function.php';


$category_names = getAllCategoryNames();
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
<form class="table-container" action="../../../backend/products/create.php" method="POST" enctype="multipart/form-data">
    <div class="table-header">
        <h2 class="table-title">Product Create</h2>
        <a href="/backend.php?folder=products&page=index" class="create_button">Back</a>
    </div>
    <div class="main_create_form">
        <div class="create_form_group">
            <label for="name">Name</label>
            <input name="name" id="name" value="<?= $data['name'] ?>">
            <?php
            if (isset($_SESSION['name'])) {
                echo '<p class="alert alert-error" style="color: red; margin-top: 5px">' . $_SESSION['name'] . '</p>';
                unset($_SESSION['name']);
            }
            ?>
        </div>

        <div class="create_form_group">
            <label for="slug">Slug</label>
            <input name="slug" id="slug" value="<?= $data['slug'] ?>">
            <?php
            if (isset($_SESSION['slug'])) {
                echo '<p class="alert alert-error" style="color: red; margin-top: 5px">' . $_SESSION['slug'] . '</p>';
                unset($_SESSION['slug']);
            }
            ?>
        </div>

        <div class="create_form_group">
            <label for="stock_no">Stock No</label>
            <input name="stock_no" id="stock_no" value="<?= $data['stock_no'] ?>">
            <?php
            if (isset($_SESSION['stock_no'])) {
                echo '<p class="alert alert-error" style="color: red; margin-top: 5px">' . $_SESSION['stock_no'] . '</p>';
                unset($_SESSION['stock_no']);
            }
            ?>
        </div>

        <div class="create_form_group">
            <label for="price">Price</label>
            <input name="price" id="price" value="<?= $data['price'] ?>">
            <?php
            if (isset($_SESSION['price'])) {
                echo '<p class="alert alert-error" style="color: red; margin-top: 5px">' . $_SESSION['price'] . '</p>';
                unset($_SESSION['price']);
            }
            ?>
        </div>

        <div class="create_form_group">
            <label for="images">Images</label>
            <input type="file" accept="image/*" name="images[]" id="image" multiple required>
        </div>

        <div class="create_form_group">
            <label for="category_id">Category ID</label>
            <select name="category_id" id="">
                <option value="">Select category</option>
                <?php foreach ($category_names as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= $category['name'] == $data['category_id'] ? 'selected' : '' ?>>
                        <?= $category['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($_SESSION['category_id'])) {
                echo '<p class="alert alert-error" style="color: red; margin-top: 5px">' . $_SESSION['category_id'] . '</p>
            ';
                unset($_SESSION['category_id']);
            }
            ?>
        </div>

        <div class="create_form_group">
            <label for="description">Description</label>
            <textarea name="description" id="description"><?= $data['description'] ?></textarea>
        </div>

    </div>
    <!-- <div class="flex items-center" style="margin-left: 20px">
        <div class="custom-checkbox-container">
            <input type="checkbox" id="is_primary" name="is_primary" value="1" class="custom-checkbox">
            <label for="is_primary" class="custom-label">Set first uploaded image as primary</label>
        </div>
    </div> -->
    <div class="flex justify-end">
        <button class="create_submit_btn" style="margin: 0 20px 20px 0;" type="submit">Create</button>
    </div>
</form>