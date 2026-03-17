<?php
$pageTitle = 'Home';
require_once __DIR__ . '/includes/header.php';

$stmt = $pdo->query('SELECT id, name, description, price, image_url FROM products ORDER BY RAND() LIMIT 3');
$featuredProducts = $stmt->fetchAll();

$homeDeals = $pdo->query('SELECT id, title, tag, short_note, deal_price_lkr, original_price_lkr, image_url FROM deals WHERE is_active = 1 ORDER BY id DESC LIMIT 3')->fetchAll();
?>

<!-- ── Hero Splash ───────────────────────────────── -->
<section class="hero-splash">
    <div class="hero-mosaic" aria-hidden="true">
        <img src="https://images.unsplash.com/photo-1550547660-d9450f859349?w=900&auto=format&fit=crop" alt="">
        <img src="https://images.unsplash.com/photo-1639024471283-03518883512d?w=900&auto=format&fit=crop" alt="">
        <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=900&auto=format&fit=crop" alt="">
        <img src="https://images.unsplash.com/photo-1557872943-16a5ac26437e?w=900&auto=format&fit=crop" alt="">
        <img src="https://images.unsplash.com/photo-1544025162-d76694265947?w=900&auto=format&fit=crop" alt="">
        <img src="https://images.unsplash.com/photo-1603894584373-5ac82b2ae398?w=900&auto=format&fit=crop" alt="">
    </div>
    <div class="hero-overlay"></div>
    <div class="wrap hero-content">
        <p class="hero-kicker">Fast Delivery &bull; Freshly Made &bull; Best Deals</p>
        <h1 class="hero-title">CRAVEBITES</h1>
        <p class="hero-sub">Fresh sharing the finest bites — delivered with passion to your door across Colombo and its lanes.</p>
        <div class="hero-actions">
            <a class="btn btn-hero" href="<?php echo url('products.php'); ?>">Order Now</a>
            <a class="btn-outline-hero" href="<?php echo url('deals.php'); ?>">See Deals</a>
        </div>
    </div>
</section>

<!-- ── Featured Products ──────────────────────────── -->
<section class="wrap section">
    <div class="section-head">
        <h2>Featured <span style="color:var(--brand)">Products</span></h2>
        <a href="<?php echo url('products.php'); ?>">See Full Menu &rarr;</a>
    </div>
    <div class="grid home-feat-grid">
        <?php foreach ($featuredProducts as $item): ?>
            <article class="home-feat-card">
                <div class="home-feat-img">
                    <img src="<?php echo escape($item['image_url'] ?: 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800'); ?>" alt="<?php echo escape($item['name']); ?>">
                    <div class="home-feat-img-overlay"></div>
                </div>
                <div class="home-feat-body">
                    <h3><?php echo escape($item['name']); ?></h3>
                    <p><?php echo escape($item['description']); ?></p>
                    <div class="home-feat-foot">
                        <strong class="home-feat-price">LKR <?php echo format_price((float) $item['price']); ?></strong>
                        <?php if (is_user_logged_in()): ?>
                            <form method="POST" action="<?php echo url('cart.php'); ?>" class="inline-form">
                                <input type="hidden" name="action" value="add">
                                <input type="hidden" name="product_id" value="<?php echo (int) $item['id']; ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-sm">Add to Cart</button>
                            </form>
                        <?php else: ?>
                            <a class="btn btn-sm" href="<?php echo url('signin.php'); ?>">Order Now</a>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<!-- ── Deals Of The Week ─────────────────────────── -->
<section class="home-deals-banner">
    <div class="wrap">
        <div class="section-head">
            <h2>Deals <span style="color:var(--brand)">Of The Week</span></h2>
            <a href="<?php echo url('deals.php'); ?>">View All Deals &rarr;</a>
        </div>
        <div class="grid home-deals-grid">
            <?php if ($homeDeals): ?>
                <?php foreach ($homeDeals as $deal): ?>
                    <article class="home-deal-card">
                        <?php if ($deal['image_url']): ?>
                            <img src="<?php echo escape($deal['image_url']); ?>" alt="<?php echo escape($deal['title']); ?>">
                        <?php endif; ?>
                        <div class="home-deal-body">
                            <?php if ($deal['tag']): ?>
                                <span class="deal-tag"><?php echo escape($deal['tag']); ?></span>
                            <?php endif; ?>
                            <h3><?php echo escape($deal['title']); ?></h3>
                            <p><?php echo escape($deal['short_note']); ?></p>
                            <div class="deal-pricing">
                                <strong>LKR <?php echo number_format($deal['deal_price_lkr'], 0); ?></strong>
                                <?php if ($deal['original_price_lkr'] > 0): ?>
                                    <span>LKR <?php echo number_format($deal['original_price_lkr'], 0); ?></span>
                                <?php endif; ?>
                            </div>
                            <a class="btn btn-sm" style="margin-top:0.8rem;display:inline-block" href="<?php echo url('deals.php'); ?>">Grab Deal</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <article class="home-deal-card">
                    <div class="home-deal-body">
                        <h3>Deals Coming Soon</h3>
                        <p>We are preparing fresh combo offers for you. Check back soon!</p>
                    </div>
                </article>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ── Why CraveBites ─────────────────────────────── -->
<section class="wrap section home-why">
    <h2 style="text-align:center;margin-bottom:1.5rem">Why Choose <span style="color:var(--brand)">CraveBites?</span></h2>
    <div class="grid home-why-grid">
        <div class="why-card">
            <span class="why-icon">🔥</span>
            <h4>Freshly Cooked</h4>
            <p>Every dish is made to order from fresh ingredients, never reheated frozen meals.</p>
        </div>
        <div class="why-card">
            <span class="why-icon">⚡</span>
            <h4>Express Delivery</h4>
            <p>Need it fast? Our express option gets your order to you in 45–60 minutes.</p>
        </div>
        <div class="why-card">
            <span class="why-icon">💰</span>
            <h4>Great Value Deals</h4>
            <p>Save more with our weekly combo deals designed for every appetite and budget.</p>
        </div>
        <div class="why-card">
            <span class="why-icon">📍</span>
            <h4>Colombo Delivery</h4>
            <p>We deliver across Colombo and surrounding areas — fast, reliable, every day.</p>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
