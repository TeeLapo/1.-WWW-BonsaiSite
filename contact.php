<header class="header glass-header" id="mainHeader">
    <div class="container">
      <a href="index.php" class="logo-link">
        <h1 class="logo">Bonsai Studio</h1>
        <img src="assets/bonsai.png" alt="Bonsai Studio Logo" class="logo-image">
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
