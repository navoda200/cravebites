<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    $id = (int) ($_POST['id'] ?? 0);
    $stmt = $pdo->prepare('DELETE FROM deals WHERE id = :id');
    $stmt->execute([':id' => $id]);
    set_flash('success', 'Deal deleted.');
    redirect('/admin/deals.php');
}

$deals = $pdo->query('SELECT id, title, tag, deal_price_lkr, original_price_lkr, is_active, created_at FROM deals ORDER BY id DESC')->fetchAll();

$pageTitle = 'Manage Deals';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="wrap section">
    <div class="section-head">
        <h1>Manage Deals</h1>
        <a class="btn" href="<?php echo url('admin/deal_form.php'); ?>">Add Deal</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Tag</th>
                    <th>Deal (LKR)</th>
                    <th>Original (LKR)</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deals as $deal): ?>
                    <tr>
                        <td><?php echo (int) $deal['id']; ?></td>
                        <td><?php echo escape($deal['title']); ?></td>
                        <td><?php echo escape($deal['tag'] ?: '-'); ?></td>
                        <td><?php echo number_format((float) $deal['deal_price_lkr'], 0); ?></td>
                        <td><?php echo number_format((float) $deal['original_price_lkr'], 0); ?></td>
                        <td><?php echo (int) $deal['is_active'] === 1 ? 'Active' : 'Hidden'; ?></td>
                        <td><?php echo escape(date('Y-m-d', strtotime($deal['created_at']))); ?></td>
                        <td class="actions">
                            <a href="<?php echo url('admin/deal_form.php?id=' . (int) $deal['id']); ?>">Edit</a>
                            <form method="post" action="<?php echo url('admin/deals.php'); ?>" onsubmit="return confirm('Delete this deal?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo (int) $deal['id']; ?>">
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