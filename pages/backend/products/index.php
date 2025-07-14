<?php
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/function.php';
$products = getAllProducts();

$id = $_GET['id'] ?? null;
if ($id) {
    $pdo->prepare("DELETE FROM products WHERE id = ?")->execute([$id]);
}
?>
<div class="table-container">
    <table class="table">
        <div class="table-header flex items-center justify-between">
            <h2 class="table-title">Products List</h2>
            <a href="backend.php?folder=products&page=create" class="btn btn-primary">Create New</a>
        </div>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Image</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><img src="/public/uploads/products/<?= $product['product_image'] ?>" alt="" width="50px"
                            height="50px"></td>
                    <td><?= $product['category_name'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td style="width: 10%;"><span
                            class="status-badge <?= $product['status'] == 1 ? 'success' : 'error' ?>"><?= $product['status'] == 1 ? 'Active' : 'Inactive' ?></span>
                    </td>
                    <td><span
                            class="status-badge <?= $product['is_featured'] == 1 ? 'success' : 'error' ?>"><?= $product['is_featured'] == 1 ? 'Yes' : 'No' ?></span>
                    </td>
                    <td><?= $product['created_at'] ?></td>
                    <td style="width: 10%;">
                        <div class="action-icon dropdown">
                            <i class="fa-solid fa-gear" onclick="toggleDropdown(this)"></i>
                            <div class="dropdown-menu" style="display: none;">
                                <a href="/backend.php?folder=products&page=edit&id=<?= $product['id'] ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="../../../backend/products/toggle_status.php?id=<?= $product['id'] ?>"><i
                                        class="fa fa-toggle-on"></i><?php echo $product['status'] == 1 ? ' Inactive' : ' Active' ?></a>
                                <a href="../../../backend/products/featured.php?id=<?= $product['id'] ?>"><i
                                        class="fa fa-toggle-on"></i><?php echo $product['is_featured'] == 1 ? ' Unset Featured' : ' Set Featured' ?></a>
                                <a href="/backend.php?folder=products&page=details&id=<?= $product['id'] ?>"><i
                                        class="fa fa-eye"></i> Details</a>
                                <a href="../../../backend/products/delete.php?id=<?= $product['id'] ?>"
                                    onclick="return confirm('Are you sure to delete this item?')">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>