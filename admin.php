<?php
require_once 'admin-check.php'; // Ensure the user is an admin before accessing this page

// --- Fetch Dashboard Stats ---
// These queries provide the "At-a-Glance" view
$user_count = $pdo->query("SELECT count(*) FROM users")->fetchColumn();
$service_count = $pdo->query("SELECT count(*) FROM services")->fetchColumn();
$pending_projects_count = $pdo->query("SELECT count(*) FROM projects WHERE status = 'Pending Quote'")->fetchColumn(); // From a previous step
?>

<?php $page_title = "Bonsai Studio – Admin Dashboard"; ?>
<?php require_once('header.php'); ?>
    <main class="container">
        
        <h2>Site Overview</h2>
        <div class="card-container">
            <div class="service-card">
                <h3>Total Users</h3>
                <p><?php echo $user_count; ?></p>
            </div>
            <div class="service-card">
                <h3>Total Services</h3>
                <p><?php echo $service_count; ?></p>
            </div>
            <div class="service-card">
                <h3>Pending Projects</h3>
                <p><?php echo $pending_projects_count; ?></p>
            </div>
        </div>

        <hr style="margin: 2rem 0;">

        <h2>Management Tools</h2>
        <div class="card-container">

            <div class="service-card admin-icon">
                <h3>User Administration</h3>
                <span class = "material-symbols-outlined">Groups</span>
                <a href="user-admin.php" class="cta-button admin">Manage Users</a>
            </div>

            <div class="service-card admin-icon">
                <h3>Service Administration</h3>
                <span class = "material-symbols-outlined">Build</span>
                <a href="services-admin.php" class="cta-button admin">Manage Services</a>
            </div>

            <div class="service-card admin-icon">
                <h3>Site Configuration</h3>
                <span class = "material-symbols-outlined">Palette</span>
                <a href="site_settings.php" class="cta-button admin">Edit Settings</a>
            </div>
        </div>
    </main>
</body>
</html>