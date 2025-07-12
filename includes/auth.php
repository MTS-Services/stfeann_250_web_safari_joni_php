<?php
require_once __DIR__ . '/../includes/config.php';
$pageTitle = "Login";

if ($auth->isLoggedIn()) {
    header("Location: /dashboard");
    exit;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if ($auth->login($email, $password)) {
        header("Location: /dashboard");
        exit;
    } else {
        $error = "Invalid email or password!";
    }
}

include __DIR__ . '/../includes/header.php';
?>

<h1>Login</h1>
<?php if (isset($error)): ?>
    <div class="alert error"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>