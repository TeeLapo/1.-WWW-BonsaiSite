<?php $page_title = "Bonsai Studio – Dashboard"; ?>
<?php require_once('header.php'); ?>
<?php $user_id = $_SESSION['user_id'] ?? null; // Get user ID from session ?>
<?php $username = $_SESSION['username'] ?? null; // Get username from session ?>

<section>
        <h1>Dashboard</h1>
        <p>Welcome to your dashboard, <?= htmlspecialchars($username) ?>!</p>
</section>
<main class="dashboard-content">
    <h2>AI Projects</h2>
    <p>The status of your projects will be displayed here.</p>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $projects = $stmt->fetchAll();
    if (!$projects) {
        echo "No projects found.";
    }
    foreach ($projects as $project) {
        echo "<div class='project'>";
            echo "<h3>" . htmlspecialchars($project['project_name']) . "</h3>";
            echo "<ul class='project-details'>";
                echo "<li><em>Status</em>: " . htmlspecialchars($project['status']) . "</li>";
                echo "<li><em>Created on</em>: " . htmlspecialchars($project['created_at']) . "</li>";
                echo "<li><em>Constraints</em>: " . htmlspecialchars($project['constraints']) . "</li>";
                echo "<li><em>Goals</em>: " . htmlspecialchars($project['goals']) . "</li>";
                echo "<li><em>Assistant Roles</em>: " . htmlspecialchars($project['assistant_roles']) . "</li>";
                echo "<li><em>Workflow</em>: " . htmlspecialchars($project['workflow']) . "</li>";
            echo "</ul>";   
        echo "</div>";
        echo "<hr>";
    }
    ?>
    <section>
        <form method="POST" action="create-project.php">
            <label for="project_name">Project Name:</label>
            <input type="text" id="project_name"
                   name="project_name" required>
            <br>
            <label for="goals">Goals:</label>
            <textarea class="projectAttribute" name="goals" required></textarea>
            <br>
            <label for="constraints">Constraints:</label>
            <textarea class="projectAttribute" name="constraints" required></textarea>
            <br>
            <label for="workflow">Workflow:</label>
            <textarea class="projectAttribute" name="workflow" required></textarea>
            <br>
            <label for="assistant_roles">Assistant Roles:</label>
            <textarea class="projectAttribute" name="assistant_roles" required></textarea>
            <br>
            
            <button formaction="create-project.php" class="cta-button">+ Create New Project</button>
        </form>
    </section>
</main>
<?php require_once('footer.php'); ?>