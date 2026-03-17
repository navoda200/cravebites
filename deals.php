<?php
$pageTitle = 'Deals';
require_once __DIR__ . '/includes/header.php';

$deals = $pdo->query('SELECT id, title, tag, short_note, items_text, deal_price_lkr, original_price_lkr, image_url FROM deals WHERE is_active = 1 ORDER BY id DESC')->fetchAll();
?>

<section class="wrap section">
    <div class="section-head">
        <h1>Deals</h1>
        <p>Fresh combo offers picked for value and variety.</p>
    </div>

    <?php if ($deals): ?>
        <div class="grid deals-grid">
            <?php foreach ($deals as $deal): ?>
                <article class="deal-card">
                    <img src="<?php echo escape($deal['image_url'] ?: 'https://via.placeholder.com/800x500'); ?>" alt="<?php echo escape($deal['title']); ?>">
                    <div class="deal-body">
                        <p class="deal-tag"><?php echo escape($deal['tag'] ?: 'Special'); ?></p>
                        <h2><?php echo escape($deal['title']); ?></h2>
                        <p><?php echo escape($deal['short_note']); ?></p>
                        <ul>
                            <?php foreach (preg_split('/\r\n|\r|\n/', (string) $deal['items_text']) as $line): ?>
                                <?php if (trim($line) !== ''): ?>
                                    <li><?php echo escape(trim($line)); ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                        <div class="deal-pricing">
                            <strong>LKR <?php echo number_format((float) $deal['deal_price_lkr'], 0); ?></strong>
                            <?php if ((float) $deal['original_price_lkr'] > 0): ?>
                                <span>LKR <?php echo number_format((float) $deal['original_price_lkr'], 0); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <article class="news-item">
            <h2>No deals yet</h2>
            <p>Add your first deal from the admin panel to show offers here.</p>
        </article>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>