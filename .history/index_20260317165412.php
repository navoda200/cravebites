<?php
$pageTitle = 'Home';
require_once __DIR__ . '/includes/header.php';

$stmt = $pdo->query('SELECT id, name, description, price, image_url FROM products WHERE category = "Main Courses" ORDER BY id DESC LIMIT 3');
$featuredProducts = $stmt->fetchAll();

$newsStmt = $pdo->query('SELECT id, title, body, published_at FROM news ORDER BY id DESC LIMIT 2');
$latestNews = $newsStmt->fetchAll();
?>

<section class="hero">
    <div class="wrap hero-grid">
        <div>
            <p class="kicker">Fresh. Fast. Reliable.</p>
            <h1>Your favorite meals, delivered with care</h1>
            <p>CraveBites is your online food business platform with delicious menu options and regular updates.</p>
            <div class="hero-actions">
                <a class="btn" href="<?php echo url('products.php'); ?>">Explore Menu</a>
                <a class="btn btn-outline" href="<?php echo url('contact.php'); ?>">Contact Us</a>
            </div>
        </div>
    </div>
</section>

<section class="wrap section">
    <div class="section-head">
        <h2>Featured Products</h2>
        <a href="<?php echo url('products.php'); ?>">View All</a>
    </div>
    <div class="grid cards">
        <?php foreach ($featuredProducts as $item): ?>
            <article class="card">
                <img src="<?php echo escape($item['image_url'] ?: 'https://via.placeholder.com/600x380'); ?>" alt="<?php echo escape($item['name']); ?>">
                <div class="card-body">
                    <h3><?php echo escape($item['name']); ?></h3>
                    <p><?php echo escape($item['description']); ?></p>
                    <strong>LKR <?php echo format_price((float) $item['price']); ?> / portion</strong>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="wrap section">
    <div class="section-head">
        <h2>Latest News</h2>
        <a href="<?php echo url('news.php'); ?>">Read More</a>
    </div>
    <div class="grid news-grid">
        <?php foreach ($latestNews as $post): ?>
            <article class="news-card">
                <h3><?php echo escape($post['title']); ?></h3>
                <p><?php echo escape($post['body']); ?></p>
                <small><?php echo escape(date('Y-m-d', strtotime($post['published_at']))); ?></small>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
