<?php
$pageTitle = 'Products';
require_once __DIR__ . '/includes/header.php';

$stmt = $pdo->query('SELECT id, name, description, price, image_url, category FROM products ORDER BY id DESC');
$products = $stmt->fetchAll();

$sections = [
    'Main Courses' => [],
    'Sides' => [],
    'Beverages and Drinks' => [],
];

foreach ($products as $item) {
    $category = $item['category'] ?? 'Main Courses';
    if (!array_key_exists($category, $sections)) {
        $category = 'Main Courses';
    }
    $sections[$category][] = $item;
}
?>

<section class="wrap section">
    <div class="section-head">
        <h1>Our Menu</h1>
        <p>Pick your favorites from mains, sides, and drinks.</p>
    </div>

    <?php foreach ($sections as $sectionName => $items): ?>
        <div class="section-head">
            <h2><?php echo escape($sectionName); ?></h2>
            <p><?php echo count($items); ?> options</p>
        </div>

        <div class="grid cards">
            <?php foreach ($items as $item): ?>
                <article class="card">
                    <img src="<?php echo escape($item['image_url'] ?: 'https://via.placeholder.com/600x380'); ?>" alt="<?php echo escape($item['name']); ?>">
                    <div class="card-body">
                        <h3><?php echo escape($item['name']); ?></h3>
                        <p><?php echo escape($item['description']); ?></p>
                        <strong>LKR <?php echo format_price((float) $item['price']); ?> / portion</strong>
                        <form method="post" action="<?php echo url('cart.php'); ?>" class="card-actions">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="product_id" value="<?php echo (int) $item['id']; ?>">
                            <input type="hidden" name="quantity" value="1">
                            <button class="btn" type="submit">Add to Cart</button>
                        </form>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
