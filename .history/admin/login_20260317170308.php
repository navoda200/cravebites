<?php
require_once __DIR__ . '/../includes/bootstrap.php';

if (is_admin_logged_in()) {
    redirect('/admin/dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $validUser = 'admin';
    $validPass = 'admin123';

    if ($username === $validUser && $password === $validPass) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        set_flash('success', 'Welcome back. You are now signed in.');
        redirect('/admin/dashboard.php');
    }

    set_flash('error', 'Login failed. Please check your username and password.');
    redirect('/admin/login.php');
}

$pageTitle = 'Admin Login';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="wrap section auth-wrap">
    <h1>Admin Sign In</h1>
    <form class="form auth-form" method="post" action="<?php echo url('admin/login.php'); ?>">
        <label for="username">Username</label>
        <input id="username" name="username" type="text" required>

        <label for="password">Password</label>
        <input id="password" name="password" type="password" required>

        <button class="btn" type="submit">Sign In</button>
        <p class="small-note">Demo login: admin / admin123</p>
    </form>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
