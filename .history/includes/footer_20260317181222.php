    </main>

    <footer class="site-footer">
        <div class="wrap footer-grid">
            <div>
                <h3>CraveBites</h3>
                <p class="footer-copy">Freshly made meals, sides, and drinks delivered across Colombo.</p>
            </div>

            <div>
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo url('index.php'); ?>">Home</a></li>
                    <li><a href="<?php echo url('products.php'); ?>">Products</a></li>
                    <li><a href="<?php echo url('deals.php'); ?>">Deals</a></li>
                    <li><a href="<?php echo url('contact.php'); ?>">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4>Contact</h4>
                <ul class="footer-links">
                    <li><a href="tel:+94771234567">+94 77 123 4567</a></li>
                    <li><a href="mailto:hello@cravebites.com">hello@cravebites.com</a></li>
                    <li>Colombo, Sri Lanka</li>
                </ul>
            </div>

            <div>
                <h4>Follow Us</h4>
                <ul class="footer-links">
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">TikTok</a></li>
                </ul>
            </div>
        </div>

        <div class="wrap footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> CraveBites. All rights reserved.</p>
        </div>
    </footer>

    <?php
    $jsPath = __DIR__ . '/../public/js/main.js';
    $jsVersion = file_exists($jsPath) ? filemtime($jsPath) : time();
    ?>
    <script src="<?php echo url('public/js/main.js?v=' . $jsVersion); ?>"></script>
</body>
</html>
