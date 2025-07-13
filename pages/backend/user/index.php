<div class="table-container">

    <div class="table-header">
        <h2 class="table-title">User List</h2>
        <a href="backend.php?folder=user&page=create" class="btn btn-primary">Add New</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Is Admin</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $pdo->query("SELECT * FROM users ORDER BY id DESC");
            while ($row = $result->fetch(PDO::FETCH_ASSOC)):
            ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><span class="status-badge success"><?= $row['status'] ? 'Active' : 'Inactive' ?></span></td>
                    <td><span class="status-badge error"><?= $row['is_admin'] ? 'Yes' : 'No' ?></span></td>
                    <td><?= $row['created_at'] ?></td>
                    <td>
                        <div class="action-icon dropdown">
                            <i class="fa-solid fa-gear" onclick="toggleDropdown(this)"></i>
                            <div class="dropdown-menu" style="display: none;">
                                <a href="edit.php?id=<?= $row['id'] ?>"><i class="fa fa-edit"></i> Edit</a>
                                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure to delete this item?')">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                                <a href="toggle_status.php?id=<?= $row['id'] ?>">
                                    <i class="fa fa-toggle-on"></i> Toggle Status
                                </a>
                                <a href="toggle_admin.php?id=<?= $row['id'] ?>">
                                    <i class="fa fa-toggle-on"></i> Toggle Admin
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>