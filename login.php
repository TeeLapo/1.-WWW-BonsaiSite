<?php
session_start();
require_once 'db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($input && $password) {
        $query = $pdo->prepare("SELECT * FROM users WHERE username = ?;");
        $query->execute([$input]);
        $user = $query->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid login.";
        }
    } else {
        $error = "Please enter both username and password.";
    }
}
?>
<?php require('header.php'); ?>
    <section>
    <div class="container">
        <h1 class="hide">Login</h1>
        <?php if ($error): ?>
            <div class="error-message" style="color: red; margin-bottom: 1rem;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
    <form class="login-form" action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </form>
</body>
</html>

