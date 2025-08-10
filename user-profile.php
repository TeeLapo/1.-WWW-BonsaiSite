<?php
$page_title = "Bonsai Studio – User Profile";
require_once 'header.php';

// Fetch current user's data
$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    // Update email
    $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
    $stmt->execute([$new_email, $_SESSION['user_id']]);

    // Update password if provided
    if (!empty($new_password)) {
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$hashed, $_SESSION['user_id']]);
    }

    $success = "Profile updated successfully!";
    // Refresh user data
    $stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
}
?>
    <main>
        <h2>My Profile</h2>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <form action="user-profile.php" method="post">
            <label for="email">Update Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="password">Update Password:</label>
            <input type="password" name="password" placeholder="New Password">

            <button type="submit">Update Profile</button>
            <p class="success hide"><?php echo htmlspecialchars($success); ?></p>
        </form>
        <?php if ($success): ?>
        <script>
            document.querySelector('.success').classList.remove('hide');
        </script>
        <?php endif; ?>
    </main>
</body>
</html>