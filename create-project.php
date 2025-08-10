<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $project_name = $_POST['project_name'] ?? '';
    $goals = $_POST['goals'] ?? '';
    $constraints = $_POST['constraints'] ?? '';
    $workflow = $_POST['workflow'] ?? '';
    $assistant_roles = $_POST['assistant_roles'] ?? '';
    $status = 'Created'; // Default status

    // Required field validation
    if (!$project_name || !$goals || !$workflow) {
        $_SESSION['error'] = "Project name, goals, and workflow are required.";
        header("Location: dashboard.php");
        exit;
    }

    // Insert project
    $stmt = $pdo->prepare("INSERT INTO projects (user_id, project_name, goals, constraints, workflow, assistant_roles, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $project_name, $goals, $constraints, $workflow, $assistant_roles, $status]);

    $_SESSION['confirmation'] = "Project created successfully!";
    header("Location: dashboard.php");
    exit;
} else {
    // If url is accessed directly, redirect to dashboard
    header("Location: dashboard.php");
    exit;
}
?>
