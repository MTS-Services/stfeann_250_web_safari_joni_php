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
                        <?php if (!empty($user['image'])): ?>
                            <img src="/public/uploads/<?= htmlspecialchars($user['image']) ?>"
                                alt="<?= htmlspecialchars($user['name']) ?>"
                                width="100">
                        <?php else: ?>
                            <p>No image</p>
                        <?php endif; ?>
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
                                <a href="#" class="openModalBtn"
                                    data-user='<?= json_encode($user) ?>'>
                                    <i class="fa fa-eye"></i> View
                                </a>
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

<div id="userDetailsModal" class="modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <div class="details-container" id="modalContent">
            <!-- Content will be populated via JS -->
        </div>
    </div>
</div>
<script>
    const modal = document.getElementById("userDetailsModal");
    const closeBtn = document.querySelector(".close-button");

    document.querySelectorAll(".openModalBtn").forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();

            const user = JSON.parse(this.dataset.user);
            const modalContent = document.getElementById("modalContent");

            let imageHTML = user.image ?
                `<img src="/public/uploads/${user.image}" alt="${user.name}">` :
                'No Image Available';

            modalContent.innerHTML = `
                <h2>User Details</h2>
                <table>
                    <tr><td><strong>ID:</strong></td><td>${user.id}</td></tr>
                    <tr><td><strong>Name:</strong></td><td>${user.name}</td></tr>
                    <tr><td><strong>Email:</strong></td><td>${user.email}</td></tr>
                    <tr><td><strong>Status:</strong></td><td>${user.status ? 'Active' : 'Inactive'}</td></tr>
                    <tr><td><strong>Is Admin:</strong></td><td>${user.is_admin ? 'Yes' : 'No'}</td></tr>
                    <tr><td><strong>Created At:</strong></td><td>${user.created_at}</td></tr>
                    <tr><td><strong>Image:</strong></td><td>${imageHTML}</td></tr>
                </table>
            `;

            modal.style.display = "flex";
            modal.style.opacity = "5";
        });
    });

    closeBtn.onclick = () => modal.style.display = "none";

    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>