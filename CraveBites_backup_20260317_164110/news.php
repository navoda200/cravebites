<?php
$pageTitle = 'News';
require_once __DIR__ . '/includes/header.php';

$stmt = $pdo->query('SELECT id, title, body, published_at FROM news ORDER BY id DESC');
$newsList = $stmt->fetchAll();
?>

<section class="wrap section">
    <div class="section-head">
        <h1>Business News</h1>
        <p>Stay updated with current events and offers.</p>
    </div>

    <div class="news-list">
        <?php foreach ($newsList as $post): ?>
            <article class="news-item">
                <h2><?php echo escape($post['title']); ?></h2>
                <p><?php echo escape($post['body']); ?></p>
                <small>Published: <?php echo escape(date('Y-m-d H:i', strtotime($post['published_at']))); ?></small>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
