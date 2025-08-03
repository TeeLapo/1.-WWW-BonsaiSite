<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    echo "User not found.";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>User Profile</h1>
    </header>
    <main>
        <h2>Welcome, <?= htmlspecialchars($user['name']) ?></h2>
        <p>Email: <?= htmlspecialchars($user['email']) ?></p>
        <p>Joined on: <?= htmlspecialchars($user['created_at']) ?></p>
        <a href="edit-profile.php">Edit Profile</a>
        <a href="logout.php">Logout</a>
        <h3>Your Services</h3>
        <ul>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM user_services WHERE user_id = ?");
            $stmt->execute([$user_id]);
            $services = $stmt->fetchAll();
            foreach ($services as $service) {
                echo "<li>" . htmlspecialchars($service['service_name']) . "</li>";
            }
            ?>
        </ul>
        <h3>Recent Activities</h3>
        <ul>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM user_activities WHERE user_id = ?");
            $stmt->execute([$user_id]);
            $activities = $stmt->fetchAll();
            foreach ($activities as $activity) {
                echo "<li>" . htmlspecialchars($activity['activity_description']) . "</li>";
            }
            ?>
        </ul>
        <h3>Settings</h3>
        <ul>
            <li><a href="change-password.php">Change Password</a></li>
            <li><a href="delete-account.php">Delete Account</a></li>
        </ul>
        
    </main>
</body>
</html>
<?php