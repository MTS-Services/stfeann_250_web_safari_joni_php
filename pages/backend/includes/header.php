<?php

$id = $_GET['id'] ?? null;

?>


<header class="header">
    <div class="header-left">
        <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
    </div>
    <div class="header-right">
        <div class="user-avatar" id="avatar">
            <img src="/public/backend/images/user.avif" alt="User">
        </div>
        <div class="dropdown-menu" id="avatarDropdown">
            <a href="backend.php?page=profile&id=<?= $id ?>">👤 Profile</a>
            <a href="auth/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
        </div>
    </div>
</header>