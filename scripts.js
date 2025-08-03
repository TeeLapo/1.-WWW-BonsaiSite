document.addEventListener('DOMContentLoaded', function() {
  var themeButton = document.querySelector('button[onclick="changeTheme()"]');
  themeButton.addEventListener('click', function() {
    var body = document.body;
    var all = document.querySelectorAll('*');
    var btn = document.getElementById('themeToggleBtn');
    // Remove all theme target classes first
    all.forEach(function(el) {
      el.classList.remove('dark-mode-target', 'neon-mode-target');
    });
    function isWhiteBg(el) {
      var bg = window.getComputedStyle(el).backgroundColor;
      return bg === 'rgb(255, 255, 255)' || bg === 'rgba(255, 255, 255, 1)';
    }
    if (body.classList.contains('light-theme')) {
      body.classList.remove('light-theme');
      body.classList.add('dark-mode');
      all.forEach(function(el) {
        if (isWhiteBg(el)) {
          el.classList.add('dark-mode-target');
        }
      });
      if (btn) btn.textContent = 'Dark Mode';
    } else if (body.classList.contains('dark-mode')) {
      body.classList.remove('dark-mode');
      body.classList.add('neon-mode');
      all.forEach(function(el) {
        if (isWhiteBg(el)) {
          el.classList.add('neon-mode-target');
        }
      });
      if (btn) btn.textContent = 'Neon Mode';
    } else if (body.classList.contains('neon-mode')) {
      body.classList.remove('neon-mode');
      body.classList.add('light-theme');
      if (btn) btn.textContent = 'Light Mode';
    } else {
      body.classList.add('dark-mode');
      all.forEach(function(el) {
        if (isWhiteBg(el)) {
          el.classList.add('dark-mode-target');
        }
      });
      if (btn) btn.textContent = 'Dark Mode';
    }
  });

  var hamburger = document.getElementById('hamburgerMenu');
  var navLinks = document.getElementById('mainNavLinks');
  if (hamburger && navLinks) {
    hamburger.addEventListener('click', function() {
      navLinks.classList.toggle('open');
    });
  }
});
