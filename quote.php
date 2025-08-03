<?php
include('db.php');
$quote_id = $_GET['id'] ?? null;
if ($quote_id) {
    $stmt = $pdo->prepare("SELECT * FROM quotes WHERE id = ?");
    $stmt->execute([$quote_id]);
    $quote = $stmt->fetch();
}
?>
<?php require('header.php'); ?>
<section class="quote">
  <div class="container">
    <?php if ($quote): ?>
      <h2><?= htmlspecialchars($quote['author']) ?></h2>
      <p><?= htmlspecialchars($quote['text']) ?></p>
    <?php else: ?>
      <p>Quote not found.</p>
    <?php endif; ?>
  </div>
</section>
<footer>
  <div class="container">
    <p>&copy; <?= date('Y') ?> BonsAI Studio. All rights reserved.</p>
  </div>