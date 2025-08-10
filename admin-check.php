<?php
// admin/admin_check.php

// ALWAYS start the session on pages that use session variables
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}

// Use require_once to prevent including the database connection multiple times
require_once 'db.php'; // The ../ goes up one directory level to find db.php

// --- Check 1: Is anyone even logged in? ---
if (!isset($_SESSION['user_id'])) {
    // If not, send them to the main login page
    header("Location: ../login.php"); 
    exit();
}

// --- Check 2: Does the logged-in user have admin rights right NOW? ---
$stmt = $pdo->prepare("SELECT is_admin FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// The user might not exist, or their is_admin flag might be 0 (false)
if (!$user || $user['is_admin'] != 1) {
    // Access Denied. You can show an error or redirect them.
    die("Access Denied. You do not have permission to view this page.");
}

// If the script reaches this point, the user is a verified and active admin.
?>