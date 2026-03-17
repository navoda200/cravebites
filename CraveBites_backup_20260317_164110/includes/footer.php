    </main>

    <footer class="site-footer">
        <div class="wrap">
            <p>CraveBites Online Business Website - Web Application Development Coursework</p>
        </div>
    </footer>

    <?php
    $jsPath = __DIR__ . '/../public/js/main.js';
    $jsVersion = file_exists($jsPath) ? filemtime($jsPath) : time();
    ?>
    <script src="<?php echo url('public/js/main.js?v=' . $jsVersion); ?>"></script>
</body>
</html>
