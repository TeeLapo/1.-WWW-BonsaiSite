<?php
require_once 'admin-check.php';
$page_title = "Bonsai Studio – Manage Services";
require_once('header.php');

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_service'])) {
    $id = $_POST['id'];
    $slug = $_POST['slug'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $short_description = $_POST['short_description'];
    $long_description = $_POST['long_description'];
    $icon_path = $_POST['icon_path'];
    $image_path = $_POST['image_path'];
    $stmt = $pdo->prepare("UPDATE services SET title = ?, short_description = ?, long_description = ?, slug = ?, category = ?, icon_path = ?, image_path = ? WHERE id = ?");
    $stmt->execute([$title, $short_description, $long_description, $slug, $category, $icon_path, $image_path, $id]);
}

// Handle delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_service'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
    $stmt->execute([$id]);
}

// Handle add new service
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_service'])) {
    $title = $_POST['title'];
    $short_description = $_POST['short_description'];
    $long_description = $_POST['long_description'];
    $slug = $_POST['slug'];
    $category = $_POST['category'];
    $icon_path = $_POST['icon_path'];
    $image_path = $_POST['image_path'];
    $stmt = $pdo->prepare("INSERT INTO services (title, short_description, long_description, slug, category, icon_path, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $short_description, $long_description, $slug, $category, $icon_path, $image_path]);
}

$stmt = $pdo->query("SELECT id, title, short_description, long_description, slug, category, icon_path, image_path FROM services");
$services = $stmt->fetchAll();
?>
<main class="container service-table">
    <h2>Service Management</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Short Description</th>
                <th>Long Description</th>
                <th>Slug</th>
                <th>Category</th>
                <th>Icon Path</th>
                <th>Image Path</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="service-table-body">
            <?php foreach ($services as $service): ?>
            <tr>
                <form method="post" action="">
                    <td><?php echo htmlspecialchars($service['id']); ?>
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($service['id']); ?>">
                    </td>
                    <td>
                        <input type="text" name="title" value="<?php echo htmlspecialchars($service['title']); ?>">
                    </td>
                    <td>
                        <textarea name="short_description"><?php echo htmlspecialchars($service['short_description']); ?></textarea>
                    </td>
                    <td>
                        <textarea name="long_description"><?php echo htmlspecialchars($service['long_description']); ?></textarea>
                    </td>
                    <td>
                        <input type="text" name="slug" value="<?php echo htmlspecialchars($service['slug']); ?>">
                    </td>
                    <td>
                        <input type="text" name="category" value="<?php echo htmlspecialchars($service['category']); ?>">
                    </td>
                    <td>
                        <input type="text" name="icon_path" value="<?php echo htmlspecialchars($service['icon_path']); ?>">
                    </td>
                    <td>
                        <input type="text" name="image_path" value="<?php echo htmlspecialchars($service['image_path']); ?>">
                    </td>
                    <td class="actions">
                        <button type="submit" name="update_service" class="cta-button edit-link">Save</button>
                        <button type="submit" name="delete_service" class="cta-button edit-link" onclick="return confirm('Are you sure you want to delete this service?');">Delete</button>
                    </td>
                </form>
            </tr>
            <?php endforeach; ?>
            <!-- Add new service row -->
            <tr>
                <form method="post" action="">
                    <td><!-- No ID for new service --></td>
                    <td>
                        <input type="text" name="title" placeholder="New title">
                    </td>
                    <td>
                        <textarea name="short_description" placeholder="New short description"></textarea>
                    </td>
                    <td>
                        <textarea name="long_description" placeholder="New long description"></textarea>
                    </td>
                    <td>
                        <input type="text" name="slug" placeholder="New slug">
                    </td>
                    <td>
                        <input type="text" name="category" placeholder="New category">
                    </td>
                    <td>
                        <input type="text" name="icon_path" placeholder="New icon path">
                    </td>
                    <td>
                        <input type="text" name="image_path" placeholder="New image path">
                    </td>
                    <td class="actions">
                        <button type="submit" name="add_service" class="cta-button edit-link">Add</button>
                    </td>
                </form>
            </tr>
        </tbody>
    </table>
</main>
<?php require_once('footer.php'); ?>