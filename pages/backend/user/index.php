<?php
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/function.php';
$users = getAllUsers();
?>
<style>
    /* Modal specific styles */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1000;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
        display: flex;
        /* Use flexbox to center content */
        align-items: center;
        /* Center vertically */
        justify-content: center;
        opacity: 0;
        /* Center horizontally */
    }

    .modal-content {
        background-color: #fefefe;
        margin: auto;
        /* Removed, flexbox handles centering */
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        /* Could be responsive */
        max-width: 600px;
        /* Max width for larger screens */
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        position: relative;
        /* Needed for absolute positioning of close button */
        border-radius: 8px;
        text-align: left;
        /* Reset text alignment for content */
    }

    .close-button {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        /* Position relative to modal-content */
        top: 10px;
        right: 20px;
        cursor: pointer;
    }

    .close-button:hover,
    .close-button:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* User details container styles (reused from original) */
    .details-container {
        /* Removed max-width and margin as modal-content handles it */
        padding: 0;
        /* Remove padding if added by modal-content */
        border: none;
        /* Remove border if added by modal-content */
    }

    .details-container img {
        width: 120px;
        height: auto;
        object-fit: cover;
        border-radius: 50%;
        /* Make image round if desired */
        display: block;
        /* Center the image */
        margin: 0 auto 15px auto;
        /* Center and add space below */
    }

    .details-container h2 {
        text-align: center;
        margin-top: 0;
    }

    .details-container table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        /* For clean table borders */
    }

    .details-container table td {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
        /* Light line between rows */
    }

    .details-container table tr:last-child td {
        border-bottom: none;
        /* No border for the last row */
    }

    .details-container table td:first-child {
        font-weight: bold;
        width: 30%;
        /* Adjust as needed */
    }

    .back-link {
        display: inline-block;
        margin-top: 20px;
        text-decoration: none;
        color: #007bff;
    }

    .back-link:hover {
        text-decoration: underline;
    }
</style>
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
                        <img src="/public/uploads/<?= $user['image'] ?>"
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