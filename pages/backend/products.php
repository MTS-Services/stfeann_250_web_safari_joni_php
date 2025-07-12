<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>12345</td>
                <td>Premium Plan</td>
                <td>$99.00</td>
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
            <tr>
                <td>12346</td>
                <td>Basic Plan</td>
                <td>$29.00</td>
                <td><span class="status-badge warning">Pending</span></td>
                <td>2024-01-14</td>
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
            <tr>
                <td>12347</td>
                <td>Pro Plan</td>
                <td>$199.00</td>
                <td><span class="status-badge success">Completed</span></td>
                <td>2024-01-13</td>
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
            <tr>
                <td>12348</td>
                <td>Basic Plan</td>
                <td>$29.00</td>
                <td><span class="status-badge error">Failed</span></td>
                <td>2024-01-12</td>
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