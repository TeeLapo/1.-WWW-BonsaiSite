<?php
include('db.php');
$slug = $_GET['slug'];
$stmt = $pdo->prepare("SELECT * FROM services WHERE slug = ?");
$stmt->execute([$slug]);
$service = $stmt->fetch();
if (!$service) {
    echo "Service not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta title="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $service['title']; ?> - BonsAI Studio</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header class="header">
            <div class="container">
                <h1 class="logo">🌱 BonsAI Studio</h1>
                <nav>
                    <ul class="nav-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="services-catalog.php">Services</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="login.php">Login</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <main class="container">
            <img src ="assets/images/<?php echo $service['image']; ?>" alt="<?php echo $service['title']; ?>" class="service-image">
            <h2><?php echo $service['title']; ?></h2>
            <p><?php echo $service['long_description']; ?></p>
        </main>
    </body>
</html>
