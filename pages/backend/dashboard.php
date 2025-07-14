<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../config/function.php';

// Get all users
$all_users = getAllUsers();


$active_users = 0;
foreach ($all_users as $user) {
    if (isset($user['status']) && $user['status'] == 1) {
        $active_users++;
    }
}

$active_admins = 0;
foreach ($all_users as $user) {
    if (isset($user['is_admin']) && $user['is_admin'] == 1) {
        $active_admins++;
    }
}

// Get product and category counts
$product_count = count(getAllProducts());
$categories = count(getAllCategories());
?>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-title">Active Users</div>
            <div class="stat-icon green">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="stat-value"><?php echo $active_users; ?></div>
        <div class="stat-change positive"></div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-title">Active Admins</div>
            <div class="stat-icon green2">
                <i class="fas fa-user-shield"></i>
            </div>
        </div>
        <div class="stat-value"><?php echo $active_admins; ?></div>
        <div class="stat-change positive"></div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-title">Total Categories</div>
            <div class="stat-icon yellow">
                <i class="fas fa-th-large"></i> <!-- Grid icon for categories -->
            </div>
        </div>
        <div class="stat-value"><?php echo $categories; ?></div>
        <div class="stat-change negative"></div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-title">Total Products</div>
            <div class="stat-icon blue">
                <i class="fas fa-box"></i> <!-- Box icon for products -->
            </div>
        </div>
        <div class="stat-value"><?php echo $product_count; ?></div>
        <div class="stat-change positive"></div>
    </div>

</div>