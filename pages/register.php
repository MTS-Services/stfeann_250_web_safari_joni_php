<div class="container">
    <div class="auth-wrapper">
        <!-- Register Form -->
        <div class="form-container" id="registerForm">
            <h2>Register</h2>
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success'];
                    unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <form action="/auth/register.php" method="POST">
                <div class="form-group">
                    <label for="reg_name">Full Name:</label>
                    <input type="text" id="reg_name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="reg_email">Email:</label>
                    <input type="email" id="reg_email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="reg_password">Password:</label>
                    <input type="password" id="reg_password" name="password" required minlength="6">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
            </form>

            <p class="switch-form">
                Already have an account?
                <a href="?page=login">Login here</a>
            </p>
        </div>
    </div>
</div>