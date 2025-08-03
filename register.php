<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? null;
    $password_raw = $_POST['password'] ?? null;
    if ($username && $password_raw) {
        $password = password_hash($password_raw, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);
        echo "Registration successful!";
    } else {
        echo "Username and password are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header class="header glass-header" id="mainHeader">
            <div class="container">
              <a href="index.php" class="logo-link">
                <h1 class="logo">Bonsai Studio</h1>
                <img src="assets/bonsai.png" alt="Bonsai Studio Logo" class="logo-image hide">
              </a>
              <nav>
                <div class="hamburger" id="hamburgerMenu">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
                <ul class="nav-links" id="mainNavLinks">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="services-catalog.php">Services</a></li>
                  <li><a href="about.php">About</a></li>
                  <li><a href="login.php">Login</a></li>
                  <li>
                      <select id="themeSelect" onchange="setTheme(this.value)">
                        <option value="light-theme">Light</option>
                        <option value="dark-mode">Dark</option>
                        <option value="neon-mode">Neon</option>
                      </select>
                  </li>
                </ul>
              </nav>
            </div>
        </header>
        <h1>Register</h1>
        <form class="register-form" action="register.php" method="POST">
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
            <input type="submit" value="Register">
        </form>
    </body>
</html>