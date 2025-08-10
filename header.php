<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Bonsai Studio offers AI-powered services and agentic workflows to automate business processes, optimize decision-making, and drive innovation across industries. Explore ready-to-launch AI solutions for operations, marketing, research, and more." />
  <meta name="keywords" content="AI services, agentic workflows, business automation, AI solutions, Bonsai Studio, process optimization, AI consulting, workflow automation, decision support, digital transformation, artificial intelligence, operations, marketing, research, productivity" />
  <meta name="author" content="Taylor Laporte" />
  <?php echo "<title>$page_title</title>"; ?>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>

  <script src="scripts.js"></script>
  <link rel="icon" href="assets/images/favicon.png" />
</head>
<body>
<header class="header glass-header" id="mainHeader">
    <div class="container">
        <a href="index.php" class="logo-link">
            <img src="assets/bonsai.png" alt="Bonsai Studio Logo" class="logo-image">
            <h1 class="logo">Bonsai Studio</h1>
        </a>
        <nav aria-label="Main navigation">
            <div class="hamburger" id="hamburgerMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-links" id="mainNavLinks">
                <li><a href="services-catalog.php">Services</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
            <nav aria-label="User controls">
                <ul class="user-controls">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="dashboard.php" class="material-symbols-outlined">Dashboard</a></li>
                        <li><a href="user-profile.php" class="material-symbols-outlined">Person</a></li>
                        <li><a href="logout.php" class="material-symbols-outlined">Logout</a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['is_admin'])): ?>
                        <li><a href="admin.php" class="material-symbols-outlined">Admin_Panel_Settings</a></li>
                    <?php endif; ?>
                    <li>
                        <select id="themeSelect" onchange="setTheme(this.value)">
                            <option value="light-theme">Light</option>
                            <option value="dark-mode">Dark</option>
                            <option value="neon-mode">Neon</option>
                        </select>
                    </li>
                </ul>
            </nav>
        </nav>
    </div>
</header>