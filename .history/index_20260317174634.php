<?php
$pageTitle = 'Home';
require_once __DIR__ . '/includes/header.php';

$stmt = $pdo->query('SELECT id, name, description, price, image_url FROM products WHERE category = "Main Courses" ORDER BY id DESC LIMIT 3');
$featuredProducts = $stmt->fetchAll();

$homeDeals = $pdo->query('SELECT id, title, short_note FROM deals WHERE is_active = 1 ORDER BY id DESC LIMIT 3')->fetchAll();
?>

<section class="hero">
    <div class="wrap hero-grid">
        <div>
            <p class="kicker">Fresh. Fast. Reliable.</p>
            <h1>Your favorite meals, delivered with care</h1>
            <p>From quick bites to full meals, CraveBites serves freshly made food you can enjoy every day.</p>
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
        <a href="<?php echo url('products.php'); ?>">See Full Menu</a>
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
        <h2>Deals Of The Week</h2>
        <a href="<?php echo url('deals.php'); ?>">View All Deals</a>
    </div>
    <div class="grid news-grid">
        <?php if ($homeDeals): ?>
            <?php foreach ($homeDeals as $deal): ?>
                <article class="news-card">
                    <h3><?php echo escape($deal['title']); ?></h3>
                    <p><?php echo escape($deal['short_note']); ?></p>
                    <small>See full details in Deals.</small>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <article class="news-card">
                <h3>Deals Coming Soon</h3>
                <p>We are preparing fresh combo offers for you.</p>
                <small>Please check back later.</small>
            </article>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
