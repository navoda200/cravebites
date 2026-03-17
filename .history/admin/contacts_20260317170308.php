<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    $id = (int) ($_POST['id'] ?? 0);
    $stmt = $pdo->prepare('DELETE FROM contacts WHERE id = :id');
    $stmt->execute([':id' => $id]);
    set_flash('success', 'Message deleted.');
    redirect('/admin/contacts.php');
}

$messages = $pdo->query('SELECT id, full_name, email, message, submitted_at FROM contacts ORDER BY id DESC')->fetchAll();

$pageTitle = 'Contact Messages';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="wrap section">
    <div class="section-head">
        <h1>Contact Messages</h1>
        <a class="btn btn-outline" href="<?php echo url('admin/dashboard.php'); ?>">Back to Dashboard</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Submitted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $item): ?>
                    <tr>
                        <td><?php echo (int) $item['id']; ?></td>
                        <td><?php echo escape($item['full_name']); ?></td>
                        <td><?php echo escape($item['email']); ?></td>
                        <td><?php echo escape($item['message']); ?></td>
                        <td><?php echo escape(date('Y-m-d H:i', strtotime($item['submitted_at']))); ?></td>
                        <td class="actions">
                            <form method="post" action="<?php echo url('admin/contacts.php'); ?>" onsubmit="return confirm('Delete this message?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo (int) $item['id']; ?>">
                                <button type="submit" class="link-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
