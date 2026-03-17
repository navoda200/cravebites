<?php
require_once __DIR__ . '/bootstrap.php';
$flash = get_flash();
$currentPage = basename($_SERVER['PHP_SELF']);
$pageTitle = $pageTitle ?? 'CraveBites';
$cssPath = __DIR__ . '/../public/css/styles.css';
$cssVersion = file_exists($cssPath) ? filemtime($cssPath) : time();
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
                <a class="<?php echo $currentPage === 'news.php' ? 'active' : ''; ?>" href="<?php echo url('news.php'); ?>">News</a>
                <a class="<?php echo $currentPage === 'contact.php' ? 'active' : ''; ?>" href="<?php echo url('contact.php'); ?>">Contact</a>
                <?php if (is_admin_logged_in()): ?>
                    <a href="<?php echo url('admin/dashboard.php'); ?>">Admin</a>
                    <a href="<?php echo url('admin/logout.php'); ?>">Logout</a>
                <?php else: ?>
                    <a href="<?php echo url('admin/login.php'); ?>">Admin Login</a>
                <?php endif; ?>
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
