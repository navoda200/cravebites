<?php
$pageTitle = 'News';
require_once __DIR__ . '/includes/header.php';

$stmt = $pdo->query('SELECT id, title, body, published_at FROM news ORDER BY id DESC');
$newsList = $stmt->fetchAll();

$featuredPost = $newsList[0] ?? null;
$otherPosts = array_slice($newsList, 1);
?>

<section class="wrap section news-page">
    <div class="news-top">
        <div>
            <p class="kicker">Fresh From The Kitchen</p>
            <h1>News & Updates</h1>
            <p>Catch the latest offers, seasonal menu drops, and updates from the CraveBites team.</p>
        </div>
        <div class="news-total"><?php echo count($newsList); ?> posts</div>
    </div>

    <?php if ($featuredPost): ?>
        <article class="news-featured">
            <p class="news-badge">Latest Update</p>
            <h2><?php echo escape($featuredPost['title']); ?></h2>
            <p><?php echo escape($featuredPost['body']); ?></p>
            <small>Posted on <?php echo escape(date('M d, Y \a\t h:i A', strtotime($featuredPost['published_at']))); ?></small>
        </article>

        <?php if (!empty($otherPosts)): ?>
            <div class="news-list-head">
                <h2>Earlier Updates</h2>
                <p>Recent announcements you may have missed.</p>
            </div>

            <div class="news-list news-list-modern">
                <?php foreach ($otherPosts as $post): ?>
                    <article class="news-item news-item-modern">
                        <h3><?php echo escape($post['title']); ?></h3>
                        <p><?php echo escape($post['body']); ?></p>
                        <small><?php echo escape(date('M d, Y', strtotime($post['published_at']))); ?></small>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <article class="news-empty">
            <h2>No Updates Yet</h2>
            <p>We have not posted news yet. Check back soon for promotions and announcements.</p>
        </article>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
