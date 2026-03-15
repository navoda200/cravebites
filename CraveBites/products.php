<?php
$pageTitle = 'Products';
require_once __DIR__ . '/includes/header.php';

$stmt = $pdo->query('SELECT id, name, description, price, image_url FROM products ORDER BY id DESC');
$products = $stmt->fetchAll();
?>

<section class="wrap section">
    <div class="section-head">
        <h1>Our Products</h1>
        <p>Choose from our latest meals and snacks.</p>
    </div>

    <div class="grid cards">
        <?php foreach ($products as $item): ?>
            <article class="card">
                <img src="<?php echo escape($item['image_url'] ?: 'https://via.placeholder.com/600x380'); ?>" alt="<?php echo escape($item['name']); ?>">
                <div class="card-body">
                    <h3><?php echo escape($item['name']); ?></h3>
                    <p><?php echo escape($item['description']); ?></p>
                    <strong>$<?php echo format_price((float) $item['price']); ?></strong>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
