<?php
require_once __DIR__ . '/config/config.php';
redirectIfNotLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Authentication System</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>

<body>
    <div class="container">
        <div class="dashboard">
            <header class="dashboard-header">
                <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
                <div class="user-info">
                    <span>Logged in as: <?php echo htmlspecialchars($_SESSION['user_email']); ?></span>
                    <a href="auth/logout.php" class="btn btn-secondary">Logout</a>
                    <a href="index.php" class="btn btn-secondary">Home</a>
                </div>
            </header>

            <main class="dashboard-content">
                <div class="card">
                    <h2>Dashboard</h2>
                    <p>You have successfully logged into the authentication system!</p>

                    <div class="stats">
                        <div class="stat-item">
                            <h3>User ID</h3>
                            <p><?php echo $_SESSION['user_id']; ?></p>
                        </div>
                        <div class="stat-item">
                            <h3>Account Status</h3>
                            <p class="status-active">Active</p>
                        </div>
                        <div class="stat-item">
                            <h3>Login Time</h3>
                            <p><?php echo date('Y-m-d H:i:s'); ?></p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h2>Account Actions</h2>
                    <div class="actions">
                        <button class="btn btn-primary" onclick="alert('Profile update feature coming soon!')">
                            Update Profile
                        </button>
                        <button class="btn btn-primary" onclick="alert('Password change feature coming soon!')">
                            Change Password
                        </button>
                        <button class="btn btn-danger" onclick="confirmDelete()">
                            Delete Account
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                alert('Account deletion feature coming soon!');
            }
        }
    </script>
</body>

</html>