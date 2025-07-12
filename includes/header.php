<h1>My PHP App</h1>
    <header>
        <nav>
            <?php if (isLoggedIn()): ?>
                <a href="/dashboard.php">Dashboard</a>
                <a href="/auth/logout.php">Logout</a>
            <?php else: ?>
                <a href="?page=home">Home</a> |
                <a href="?page=about">About</a> |
                <a href="?page=login">Login</a>|
                <a href="?page=register">Register</a>
            <?php endif; ?>
        </nav>
    </header>
    <hr>