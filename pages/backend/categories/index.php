<div class="table-container"></div>
<table class="table">
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
        <tr>
            <td>1</td>
            <td>Premium Plan</td>
            <td>Description</td>
            <td>Image</td>
            <td><span class="status-badge success">Completed</span></td>
            <td>2024-01-15</td>
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
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>
</div>