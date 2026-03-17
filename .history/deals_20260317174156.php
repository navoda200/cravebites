<?php
$pageTitle = 'Deals';
require_once __DIR__ . '/includes/header.php';

$mains = $pdo->query('SELECT id, name, description, price, image_url FROM products WHERE category = "Main Courses" ORDER BY id DESC LIMIT 6')->fetchAll();
$sides = $pdo->query('SELECT id, name, description, price, image_url FROM products WHERE category = "Sides" ORDER BY id DESC LIMIT 6')->fetchAll();
$drinks = $pdo->query('SELECT id, name, description, price, image_url FROM products WHERE category = "Beverages and Drinks" ORDER BY id DESC LIMIT 6')->fetchAll();

$pick = static function (array $items, int $index, array $fallback): array {
    return $items[$index] ?? $fallback;
};

$fallbackMain = ['name' => 'House Main', 'price' => 8.50, 'image_url' => 'https://via.placeholder.com/800x500'];
$fallbackSide = ['name' => 'House Side', 'price' => 3.20, 'image_url' => 'https://via.placeholder.com/800x500'];
$fallbackDrink = ['name' => 'House Drink', 'price' => 2.40, 'image_url' => 'https://via.placeholder.com/800x500'];

$comboA = [
    $pick($mains, 0, $fallbackMain),
    $pick($sides, 0, $fallbackSide),
    $pick($drinks, 0, $fallbackDrink),
];

$comboB = [
    $pick($mains, 1, $fallbackMain),
    $pick($sides, 1, $fallbackSide),
    $pick($drinks, 1, $fallbackDrink),
];

$comboC = [
    $pick($mains, 2, $fallbackMain),
    $pick($sides, 2, $fallbackSide),
    $pick($drinks, 2, $fallbackDrink),
];

$totalA = (float) $comboA[0]['price'] + (float) $comboA[1]['price'] + (float) $comboA[2]['price'];
$totalB = (float) $comboB[0]['price'] + (float) $comboB[1]['price'] + (float) $comboB[2]['price'];
$totalC = (float) $comboC[0]['price'] + (float) $comboC[1]['price'] + (float) $comboC[2]['price'];

$deals = [
    [
        'title' => 'Lunch Saver Combo',
        'tag' => 'Save 12%',
        'image' => $comboA[0]['image_url'],
        'items' => [$comboA[0]['name'], $comboA[1]['name'], $comboA[2]['name']],
        'deal_price' => $totalA * 0.88,
        'original_price' => $totalA,
    ],
    [
        'title' => 'Family Value Combo',
        'tag' => 'Save 15%',
        'image' => $comboB[0]['image_url'],
        'items' => [$comboB[0]['name'], $comboB[1]['name'], $comboB[2]['name']],
        'deal_price' => $totalB * 0.85,
        'original_price' => $totalB,
    ],
    [
        'title' => 'Weekend Chill Combo',
        'tag' => 'Save 10%',
        'image' => $comboC[0]['image_url'],
        'items' => [$comboC[0]['name'], $comboC[1]['name'], $comboC[2]['name']],
        'deal_price' => $totalC * 0.90,
        'original_price' => $totalC,
    ],
];
?>

<section class="wrap section">
    <div class="section-head">
        <h1>Deals</h1>
        <p>Fresh combo offers picked for value and variety.</p>
    </div>

    <div class="grid deals-grid">
        <?php foreach ($deals as $deal): ?>
            <article class="deal-card">
                <img src="<?php echo escape($deal['image'] ?: 'https://via.placeholder.com/800x500'); ?>" alt="<?php echo escape($deal['title']); ?>">
                <div class="deal-body">
                    <p class="deal-tag"><?php echo escape($deal['tag']); ?></p>
                    <h2><?php echo escape($deal['title']); ?></h2>
                    <ul>
                        <?php foreach ($deal['items'] as $line): ?>
                            <li><?php echo escape($line); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="deal-pricing">
                        <strong>LKR <?php echo format_price((float) $deal['deal_price']); ?></strong>
                        <span>LKR <?php echo format_price((float) $deal['original_price']); ?></span>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>