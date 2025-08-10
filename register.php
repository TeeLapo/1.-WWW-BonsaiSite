<?php
$page_title = "Bonsai Studio – Register";
?>
<?php require_once('header.php'); ?>
<?php
$confirmation = $_SESSION['confirmation'] ?? ''; // Confirmation message after successful registration
$error = $_SESSION['error'] ?? ''; // Error message for registration issues
unset($_SESSION['confirmation'], $_SESSION['error']); // Clear session messages after displaying
?>
<section>
    <h1>Register</h1>
    <form class="register-form" action="register-process.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br>
        <label for="setup-admin">
            Admin Account?
            <input type="checkbox" id="setup-admin" name="setup-admin">
        </label>
        <br>
        <input type="submit" value="Register">
        <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
    <p class="confirmation"><?php if (isset($success)) echo htmlspecialchars($success); ?></p>
    <p class="error"><?php if (isset($error)) echo htmlspecialchars($error); ?></p>
</section>
</body>
</html>