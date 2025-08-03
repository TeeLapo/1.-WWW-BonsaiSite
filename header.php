<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Bonsai App helps you create and explore branching AI prompt workflows, called prompt trees, for tasks like job searching, writing, research, and more." />
  <meta name="keywords" content="Bonsai App, Prompt Trees, AI Workflows, Job Search, Agentic AI, LangGraph, LLM, Orchestration" />
  <meta name="author" content="Taylor Laporte" />
  <title>BonsAI Studio – Full Service AI Agency</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <script src="script.js"></script>
  <link rel="icon" href="assets/images/favicon.png" />
</head>
<body>
<header class="header glass-header" id="mainHeader">
    <div class="container">
        <a href="index.php" class="logo-link">
            <img src="assets/bonsai.png" alt="Bonsai Studio Logo" class="logo-image">
            <h1 class="logo">Bonsai Studio</h1>
        </a>
        <nav>
            <div class="hamburger" id="hamburgerMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-links" id="mainNavLinks">
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