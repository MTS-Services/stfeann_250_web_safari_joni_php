<?php
//         require_once __DIR__ . '/../config/config.php';
//         $pageTitle = "Login";

//         if ($auth->isLoggedIn()) {
//             header("Location: /dashboard");
//             exit;
//         }

//         // Handle login form submission
//         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//             $email = trim($_POST['email']);
//             $password = $_POST['password'];

//             if ($auth->login($email, $password)) {
//                 header("Location: /dashboard");
//                 exit;
//             } else {
//                 $error = "Invalid email or password!";
//             }
//         }

?>

<!-- <form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <br>
    <br>
    <input type="password" name="password" placeholder="Password" required>
    <br>
    <br>
    <button type="submit">Login</button>
</form> -->


<div class="container">
    <div class="auth-wrapper">
        <!-- Login Form -->
        <div class="form-container" id="loginForm">
            <h2>Login</h2>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php echo $_SESSION['error'];
                    unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <form action="/auth/login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            <p class="switch-form">
                Don't have an account?
                <a href="?page=register">Register here</a>
            </p>
        </div>
    </div>
</div>