<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: ../login.php");
    exit();
}

$query = $pdo->query("SELECT * FROM services");
$services = $query->fetchAll();
?>

<!DOCTYPE html>
<html>
<head><title>Manage Services</title></head>
<body>
  <h1>Admin: Manage Services</h1>
  <a href="add.php">+ Add New Service</a>
  <ul>
    <?php foreach ($services as $s): ?>
      <li>
        <?= htmlspecialchars($s['title']) ?>
        <a href="edit.php?id=<?= $s['id'] ?>">Edit</a>
        <a href="delete.php?id=<?= $s['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
      </li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
