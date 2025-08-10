<?php
session_start(); // Start the session at the very top
require_once 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

// 1. Find the user in the database
$stmt = $pdo->prepare("SELECT id, username, password, is_admin FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

// 2. Verify the user and the password
if ($user && password_verify($password, $user['password'])) {
    // Password is correct, so start a new session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];

    // Redirect to the personalized dashboard
    header("Location: dashboard.php");
    $_SESSION['is_admin'] = $user['is_admin'];
    exit();
} else {
    // Invalid credentials
    header("Location: login.php?error=invalid");
    exit();
}
?>