<?php
include('db.php');
$category = $_GET['category'] ?? null;
if ($category) {
    $stmt = $pdo->prepare("SELECT * FROM services WHERE category = ?");
    $stmt->execute([$category]);
} else {
    $stmt = $pdo->query("SELECT * FROM services");
}
$services = $stmt->fetchAll();
?>
<?php require('header.php'); ?>
<section class="services">
  <div class="container">
    <h2>Our Services</h2>
    <p>At BonsAI Studio, we offer a range of AI-powered services customized to help you achieve your goals.</p>
    <div class="card-container">
      <div class="filter-buttons">
        <a href="?category=Career%20%26%20Professional%20Development" class="<?= $category === 'Career & Professional Development' ? 'active' : '' ?>">Career & Professional Development</a>
        <a href="?category=Research%20%26%20Strategy" class="<?= $category === 'Research & Strategy' ? 'active' : '' ?>">Research</a>
        <a href="?category=Marketing%20%26%20Sales%20Automation" class="<?= $category === 'Marketing & Sales Automation' ? 'active' : '' ?>">Marketing & Sales Automation</a>
        <a href="?category=Operations%20%26%20Internal%20Productivity" class="<?= $category === 'Operations & Internal Productivity' ? 'active' : '' ?>">Operations & Internal Productivity</a>
        <a href="services-catalog.php">Reset</a>
      </div>
      <?php foreach ($services as $service): ?>
        <div class="service-card" data-category="<?= htmlspecialchars($service['category']) ?>">
          <h3><?= htmlspecialchars($service['title']) ?></h3>
          <span class="service-category filter-buttons">
            <a href="services-catalog.php?category=<?= urlencode($service['category']) ?>">
              <?= htmlspecialchars($service['category']) ?> <i class="fas fa-tag"></i>
            </a>
          </span>
          <p><?= htmlspecialchars($service['short_description']) ?></p>
          <a href="services.php?slug=<?= urlencode($service['slug']) ?>" class="cta-button">Learn More</a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
