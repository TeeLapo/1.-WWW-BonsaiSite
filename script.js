function setTheme(theme) {
  var body = document.body;
  body.classList.remove("light-theme", "dark-mode", "neon-mode");
  body.classList.add(theme);
  header.classList.remove("light-theme", "dark-mode", "neon-mode");
  header.classList.add(theme);
}

function filter(category) {
  document.querySelectorAll('.service-card').forEach(card => {
    card.style.display = card.dataset.category === category ? 'block' : 'none';
  });
}

document.addEventListener('DOMContentLoaded', function() {
  var hamburger = document.getElementById('hamburgerMenu');
  var navLinks = document.getElementById('mainNavLinks');
  if (hamburger && navLinks) {
    hamburger.addEventListener('click', function() {
      navLinks.classList.toggle('open');
    });
  }
});