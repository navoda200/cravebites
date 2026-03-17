<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$id = (int) ($_GET['id'] ?? 0);
$isEdit = $id > 0;

$news = [
    'title' => '',
    'body' => '',
];

if ($isEdit) {
    $stmt = $pdo->prepare('SELECT id, title, body FROM news WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $existing = $stmt->fetch();
    if (!$existing) {
        set_flash('error', 'News post not found.');
        redirect('/admin/news.php');
    }
    $news = $existing;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $body = trim($_POST['body'] ?? '');

    if ($title === '' || $body === '') {
        set_flash('error', 'Please provide both a title and content.');
        redirect('/admin/news_form.php' . ($isEdit ? '?id=' . $id : ''));
    }

    if ($isEdit) {
        $update = $pdo->prepare('UPDATE news SET title = :title, body = :body WHERE id = :id');
        $update->execute([
            ':title' => $title,
            ':body' => $body,
            ':id' => $id,
        ]);
        set_flash('success', 'News post updated.');
    } else {
        $insert = $pdo->prepare('INSERT INTO news (title, body) VALUES (:title, :body)');
        $insert->execute([
            ':title' => $title,
            ':body' => $body,
        ]);
        set_flash('success', 'News post published.');
    }

    redirect('/admin/news.php');
}

$pageTitle = $isEdit ? 'Edit News' : 'Add News';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="wrap section">
    <h1><?php echo escape($pageTitle); ?></h1>

    <form class="form" method="post" action="<?php echo url('admin/news_form.php' . ($isEdit ? '?id=' . $id : '')); ?>">
        <label for="title">Title</label>
        <input id="title" name="title" type="text" value="<?php echo escape($news['title']); ?>" required>

        <label for="body">Content</label>
        <textarea id="body" name="body" rows="7" required><?php echo escape($news['body']); ?></textarea>

        <div class="row-gap">
            <button class="btn" type="submit"><?php echo $isEdit ? 'Update News' : 'Create News'; ?></button>
            <a class="btn btn-outline" href="<?php echo url('admin/news.php'); ?>">Cancel</a>
        </div>
    </form>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
