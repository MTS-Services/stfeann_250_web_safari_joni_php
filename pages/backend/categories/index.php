<?php
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/function.php';
$categories = getAllCategories();

$id = $_GET['id'] ?? null;
if ($id) {
    $pdo->prepare("DELETE FROM categories WHERE id = ?")->execute([$id]);
}
?>
<div class="table-container">
    <table class="table">
        <div class="table-header flex items-center justify-between">
            <h2 class="table-title">Category List</h2>
            <a href="backend.php?folder=categories&page=create" class="btn btn-primary">Create New</a>
        </div>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= $category['id'] ?></td>
                    <td><?= htmlspecialchars($category['name']) ?></td>
                    <td><?= htmlspecialchars($category['description']) ?></td>
                    <td>
                        <img src="/public/uploads/<?= $category['image'] ?>"
                            alt="<?= htmlspecialchars($category['name']) ?>"
                            width="100">
                    </td>
                    <!-- <span class="status-badge success">Completed</span> -->
                    <td><span class="<?= $category['status'] == 1 ? 'status-badge success' : 'status-badge error' ?>"><?= $category['status'] == 1 ? 'Active' : 'Inactive' ?></span></td>
                    <td><?= $category['created_at'] ?></td>
                    <td>
                        <div class="action-icon dropdown">
                            <i class="fa-solid fa-gear" onclick="toggleDropdown(this)"></i>
                            <div class="dropdown-menu" style="display: none;">
                                <a href="/backend.php?folder=categories&page=edit&id=<?= $category['id'] ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="../../../backend/categories/delete.php?id=<?= $category['id'] ?>" onclick="return confirm('Are you sure to delete this item?')">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                                <a href="toggle_status.php?id=<?= $category['id'] ?>">
                                    <i class="fa fa-toggle-on"></i> Toggle Status
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>