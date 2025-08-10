<?php
$page_title = "Bonsai Studio – Login";
?>
<?php require_once('header.php'); ?>
<div class="container">
    <h2>Login</h2>
        <section>
            <form class="login-form" action="login-process.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <input type="submit" value="Login">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </form>
        </section>
</div>
</body>
</html>

