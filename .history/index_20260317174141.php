<?php
$pageTitle = 'Home';
require_once __DIR__ . '/includes/header.php';

$stmt = $pdo->query('SELECT id, name, description, price, image_url FROM products WHERE category = "Main Courses" ORDER BY id DESC LIMIT 3');
$featuredProducts = $stmt->fetchAll();
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
        <article class="news-card">
            <h3>Lunch Saver Combo</h3>
            <p>Main + side + drink at a discounted bundle price.</p>
            <small>Available every weekday until 3:00 PM.</small>
        </article>
        <article class="news-card">
            <h3>Family Value Combo</h3>
            <p>Perfect for sharing with generous portions and better savings.</p>
            <small>Limited slots daily.</small>
        </article>
        <article class="news-card">
            <h3>Weekend Chill Combo</h3>
            <p>Your favorite comfort picks bundled for the weekend.</p>
            <small>Friday to Sunday only.</small>
        </article>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
