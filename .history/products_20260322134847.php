<?php
$pageTitle = 'Products';
require_once __DIR__ . '/includes/header.php';

$stmt = $pdo->query('SELECT id, name, description, price, image_url, category FROM products ORDER BY id DESC');
$products = $stmt->fetchAll();

$imageOverridesByName = [
    'Chicken Alfredo' => 'https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9?auto=format&fit=crop&w=1200&q=80',
    'Shrimp Fried Rice' => 'https://images.unsplash.com/photo-1516685018646-549198525c1b?auto=format&fit=crop&w=1200&q=80',
    'Garlic Bread Basket' => 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=1200&q=80',
    'Mashed Potatoes' => 'https://images.unsplash.com/photo-1630384060421-cb20d0e0649d?auto=format&fit=crop&w=1200&q=80',
    'Mac and Cheese Cup' => 'https://images.unsplash.com/photo-1482049016688-2d3e1b311543?auto=format&fit=crop&w=1200&q=80',
    'Hot Chocolate' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1200&q=80',
];

$brokenImageUrlOverrides = [
    'https://images.unsplash.com/photo-1645112411341-6c4fd023882c?w=800' => 'https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9?auto=format&fit=crop&w=1200&q=80',
    'https://unsplash.com/photos/hands-hold-a-large-sliced-burger-with-pickles-gz-W6F8OgG0' => 'https://images.unsplash.com/photo-1516685018646-549198525c1b?auto=format&fit=crop&w=1200&q=80',
    'https://images.unsplash.com/photo-1573140247632-f8fd74997d5c?w=800' => 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=1200&q=80',
    'https://images.unsplash.com/photo-1604152135912-04a579a1f4ad?w=800' => 'https://images.unsplash.com/photo-1630384060421-cb20d0e0649d?auto=format&fit=crop&w=1200&q=80',
    'https://images.unsplash.com/photo-1543332164-6e82f355bad6?w=800' => 'https://images.unsplash.com/photo-1482049016688-2d3e1b311543?auto=format&fit=crop&w=1200&q=80',
    'https://images.unsplash.com/photo-1542990253-0d0f5be5f1cd?w=800' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1200&q=80',
];

$sections = [
    'Main Courses' => [],
    'Sides' => [],
    'Beverages and Drinks' => [],
];

foreach ($products as $item) {
    $imageUrl = trim((string) ($item['image_url'] ?? ''));
    if (isset($brokenImageUrlOverrides[$imageUrl])) {
        $imageUrl = $brokenImageUrlOverrides[$imageUrl];
    }
    if (isset($imageOverridesByName[$item['name']])) {
        $imageUrl = $imageOverridesByName[$item['name']];
    }
    $item['image_url'] = $imageUrl;

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
