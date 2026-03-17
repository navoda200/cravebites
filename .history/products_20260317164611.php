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
        <h1>Our Products</h1>
        <p>Choose from our latest meals and snacks.</p>
    </div>

    <?php foreach ($sections as $sectionName => $items): ?>
        <div class="section-head">
            <h2><?php echo escape($sectionName); ?></h2>
            <p><?php echo count($items); ?> items</p>
        </div>

        <div class="grid cards">
            <?php foreach ($items as $item): ?>
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
    <?php endforeach; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
