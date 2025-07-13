<?php
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/function.php';
$users = getAllUsers();
?>
<div class="table-container">

    <div class="table-header">
        <h2 class="table-title">User List</h2>
        <a href="/backend.php?folder=user&page=create" class="btn btn-primary">Add New</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>Status</th>
                <th>Is Admin</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td>
                        <img src="/uploads/<?= htmlspecialchars($user['image']) ?>"
                            alt="<?= htmlspecialchars($user['name']) ?>"
                            width="100">
                    </td>
                    <td>
                        <a href="../../../backend/user/toggle_status.php?id=<?= $user['id'] ?>" onclick="return confirm('Change status?')">
                            <span class="status-badge <?= $user['status'] ? 'success' : 'error' ?>">
                                <?= $user['status'] ? 'Active' : 'Inactive' ?>
                            </span>
                        </a>
                    </td>
                    <td><a href="../../../backend/user/toggle_admin.php?id=<?= $user['id'] ?>" onclick="return confirm('Change admin status?')">
                            <span class="status-badge error"><?= $user['is_admin'] ? 'Yes' : 'No' ?></span>
                        </a>
                    </td>
                    <td><?= $user['created_at'] ?></td>
                    <td>
                        <div class="action-icon dropdown">
                            <i class="fa-solid fa-gear" onclick="toggleDropdown(this)"></i>
                            <div class="dropdown-menu" style="display: none;">
                                <a href="/backend.php?folder=user&page=edit&id=<?= $user['id'] ?>"><i class="fa fa-edit"></i> Edit</a>
                                <a href="../../../backend/user/delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                <a href="../../../backend/user/toggle_status.php?id=<?= $user['id'] ?>"><i class="fa fa-toggle-on"></i> Toggle Status</a>
                                <a href="../../../backend/user/toggle_admin.php?id=<?= $user['id'] ?>">
                                    <i class="fa fa-toggle-on"></i> Toggle Admin
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>