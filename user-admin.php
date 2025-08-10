<?php
require_once 'admin-check.php';
$page_title = "Bonsai Studio – Manage Users";
require_once('header.php');

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    $stmt->execute([$username, $email, $id]);
}

// Handle delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
}

// Handle add new user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $stmt = $pdo->prepare("INSERT INTO users (username, email) VALUES (?, ?)");
    $stmt->execute([$username, $email]);
}

$stmt = $pdo->query("SELECT id, username, email FROM users");
$users = $stmt->fetchAll();
?>
<main class="container">
    <h2>User Management</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <form method="post" action="">
                    <td><?php echo htmlspecialchars($user['id']); ?>
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                    </td>
                    <td>
                        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">
                    </td>
                    <td>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                    </td>
                    <td class="actions">
                        <button type="submit" name="update_user" class="cta-button edit-link">Save</button>
                        <button type="submit" name="delete_user" class="cta-button edit-link" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                    </td>
                </form>
            </tr>
            <?php endforeach; ?>
            <!-- Add new user row -->
            <tr>
                <form method="post" action="">
                    <td><!-- No ID for new user --></td>
                    <td>
                        <input type="text" name="username" placeholder="New username">
                    </td>
                    <td>
                        <input type="email" name="email" placeholder="New email">
                    </td>
                    <td class="actions">
                        <button type="submit" name="add_user" class="cta-button edit-link">Add</button>
                    </td>
                </form>
            </tr>
        </tbody>
    </table>
</main>
<?php require_once('footer.php'); ?>