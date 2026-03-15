<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    $id = (int) ($_POST['id'] ?? 0);
    $stmt = $pdo->prepare('DELETE FROM news WHERE id = :id');
    $stmt->execute([':id' => $id]);
    set_flash('success', 'News post deleted successfully.');
    redirect('/admin/news.php');
}

$newsList = $pdo->query('SELECT id, title, published_at FROM news ORDER BY id DESC')->fetchAll();

$pageTitle = 'Manage News';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="wrap section">
    <div class="section-head">
        <h1>Manage News</h1>
        <a class="btn" href="<?php echo url('admin/news_form.php'); ?>">Add News</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($newsList as $post): ?>
                    <tr>
                        <td><?php echo (int) $post['id']; ?></td>
                        <td><?php echo escape($post['title']); ?></td>
                        <td><?php echo escape(date('Y-m-d', strtotime($post['published_at']))); ?></td>
                        <td class="actions">
                            <a href="<?php echo url('admin/news_form.php?id=' . (int) $post['id']); ?>">Edit</a>
                            <form method="post" action="<?php echo url('admin/news.php'); ?>" onsubmit="return confirm('Delete this post?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo (int) $post['id']; ?>">
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
