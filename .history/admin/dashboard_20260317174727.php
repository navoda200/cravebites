<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$productCount = (int) $pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();
$dealCount = (int) $pdo->query('SELECT COUNT(*) FROM deals WHERE is_active = 1')->fetchColumn();
$contactCount = (int) $pdo->query('SELECT COUNT(*) FROM contacts')->fetchColumn();

$pageTitle = 'Admin Dashboard';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="wrap section">
    <div class="section-head">
        <h1>Admin Dashboard</h1>
        <p>Quick overview of your menu, deals page, and customer messages.</p>
    </div>

    <div class="stats-grid">
        <article class="stat-card">
            <h3><?php echo $productCount; ?></h3>
            <p>Total Products</p>
            <a href="<?php echo url('admin/products.php'); ?>">Manage Products</a>
        </article>
        <article class="stat-card">
            <h3><?php echo $dealCount; ?></h3>
            <p>Featured Deals</p>
            <a href="<?php echo url('admin/deals.php'); ?>">Manage Deals</a>
        </article>
        <article class="stat-card">
            <h3><?php echo $contactCount; ?></h3>
            <p>Contact Messages</p>
            <a href="<?php echo url('admin/contacts.php'); ?>">View Messages</a>
        </article>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
