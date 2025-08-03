<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<?php require('header.php'); ?>
<section>
    <div class="container">
        <h1>Dashboard</h1>
        <p>Welcome to your dashboard, <?= htmlspecialchars($_SESSION['user_name']) ?>!</p>
        <p>Here you can manage your quotes, services, and more.</p>
        
        <h2>Your Quotes</h2>
        <ul>
        <?php
        include('db.php');
        $stmt = $pdo->prepare("SELECT * FROM quotes WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $quotes = $stmt->fetchAll();
        foreach ($quotes as $quote) {
            echo "<li><a href='quote.php?id=" . htmlspecialchars($quote['id']) . "'>" . htmlspecialchars($quote['author']) . "</a></li>";
        }
        ?>
        </ul>
    
        <h2>Your Services</h2>
        <ul>
        <?php
        $stmt = $pdo->prepare("SELECT * FROM user_services WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $services = $stmt->fetchAll();
        foreach ($services as $service) {
            echo "<li>" . htmlspecialchars($service['service_name']) . "</li>";
        }
        ?>
        </ul>
    </div>
</section>