<?php
require_once __DIR__ . '/includes/bootstrap.php';

unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_email']);
set_flash('success', 'You have been signed out.');
redirect('/index.php');
