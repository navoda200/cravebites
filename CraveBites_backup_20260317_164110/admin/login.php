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
        set_flash('success', 'Welcome to the admin dashboard.');
        redirect('/admin/dashboard.php');
    }

    set_flash('error', 'Invalid username or password.');
    redirect('/admin/login.php');
}

$pageTitle = 'Admin Login';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="wrap section auth-wrap">
    <h1>Admin Login</h1>
    <form class="form auth-form" method="post" action="<?php echo url('admin/login.php'); ?>">
        <label for="username">Username</label>
        <input id="username" name="username" type="text" required>

        <label for="password">Password</label>
        <input id="password" name="password" type="password" required>

        <button class="btn" type="submit">Login</button>
        <p class="small-note">Demo credentials: admin / admin123</p>
    </form>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
