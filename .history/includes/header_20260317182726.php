<?php
require_once __DIR__ . '/bootstrap.php';
$flash = get_flash();
$currentPage = basename($_SERVER['PHP_SELF']);
$pageTitle = $pageTitle ?? 'CraveBites';
$cssPath = __DIR__ . '/../public/css/styles.css';
$cssVersion = file_exists($cssPath) ? filemtime($cssPath) : time();
$cartCount = 0;

if (is_user_logged_in()) {
    $cartCount = cart_item_count($pdo, current_user_id());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo escape($pageTitle); ?> | CraveBites</title>
    <link rel="stylesheet" href="<?php echo url('public/css/styles.css?v=' . $cssVersion); ?>">
</head>
<body>
    <header class="site-header">
        <div class="wrap nav-row">
            <a class="brand" href="<?php echo url('index.php'); ?>">CraveBites</a>
            <button class="menu-btn" id="menuBtn" aria-label="Toggle navigation">Menu</button>
            <nav class="nav" id="mainNav">
                <a class="<?php echo $currentPage === 'index.php' ? 'active' : ''; ?>" href="<?php echo url('index.php'); ?>">Home</a>
                <a class="<?php echo $currentPage === 'products.php' ? 'active' : ''; ?>" href="<?php echo url('products.php'); ?>">Products</a>
                <a class="<?php echo $currentPage === 'deals.php' ? 'active' : ''; ?>" href="<?php echo url('deals.php'); ?>">Deals</a>
                <a class="<?php echo $currentPage === 'contact.php' ? 'active' : ''; ?>" href="<?php echo url('contact.php'); ?>">Contact</a>
                <a class="<?php echo $currentPage === 'cart.php' ? 'active' : ''; ?>" href="<?php echo url('cart.php'); ?>">Cart<?php echo $cartCount > 0 ? ' (' . $cartCount . ')' : ''; ?></a>
                <?php if (is_user_logged_in()): ?>
                    <a href="<?php echo url('signout.php'); ?>">Sign Out</a>
                <?php else: ?>
                    <a class="<?php echo $currentPage === 'signin.php' ? 'active' : ''; ?>" href="<?php echo url('signin.php'); ?>">Sign In</a>
                    <a class="<?php echo $currentPage === 'signup.php' ? 'active' : ''; ?>" href="<?php echo url('signup.php'); ?>">Sign Up</a>
                <?php endif; ?>
                <?php if (is_admin_logged_in()): ?>
                    <a href="<?php echo url('admin/dashboard.php'); ?>">Admin</a>
                    <a href="<?php echo url('admin/logout.php'); ?>">Logout</a>
                <?php else: ?>
                    <a href="<?php echo url('admin/login.php'); ?>">Admin Login</a>
                <?php endif; ?>
                <a class="btn nav-order-btn" href="<?php echo url('products.php'); ?>">Order Now</a>
            </nav>
        </div>
    </header>

    <?php if ($flash): ?>
        <div class="wrap">
            <div class="alert <?php echo escape($flash['type']); ?>">
                <?php echo escape($flash['message']); ?>
            </div>
        </div>
    <?php endif; ?>

    <main>
