<?php
session_start();
require_once 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $password_raw = $_POST['password'] ?? null;
    $confirm_password = $_POST['confirm_password'] ?? null;
    $is_admin = isset($_POST['setup-admin']) ? 1 : 0;

    // Ensure all fields are filled
    if (empty($username) || empty($email) || empty($password_raw)) {
        $_SESSION['error'] = "Please fill all required fields.";
        header("Location: register.php");
        exit;
    }

    // Compare password equals confirm_password
    if ($password_raw !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: register.php");
        exit;
    }

    // Check if username or email already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    if ($stmt->fetch()) {
        $_SESSION['error'] = "Username or email already exists.";
        header("Location: register.php");
        exit;
    }

    // Hash the password for security
    $password = password_hash($password_raw, PASSWORD_DEFAULT);

    // Attempt to insert new user into the database
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, is_admin) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $password, $is_admin]);

        // Redirect to login page after success
        $_SESSION['confirmation'] = "Registration successful! You can now log in.";
        header("Location: login.php?status=success");
        exit;

    } catch (PDOException $e) {
        // Check if it's a duplicate entry error
        if ($e->getCode() == 23000) {
            $_SESSION['error'] = "Username or email already exists.";
            header("Location: register.php");
            exit;
        } else {
            $_SESSION['error'] = "Database error: " . $e->getMessage();
            header("Location: register.php");
            exit;
        }
    }
}
?>