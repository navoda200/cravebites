<?php
require_once __DIR__ . '/includes/bootstrap.php';

if (is_user_logged_in()) {
    redirect('/products.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = (string) ($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        set_flash('error', 'Please enter your email and password.');
        redirect('/signin.php');
    }

    $stmt = $pdo->prepare('SELECT id, full_name, email, password_hash FROM users WHERE email = :email LIMIT 1');
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, (string) $user['password_hash'])) {
        set_flash('error', 'Invalid email or password.');
        redirect('/signin.php');
    }

    $_SESSION['user_id'] = (int) $user['id'];
    $_SESSION['user_name'] = (string) $user['full_name'];
    $_SESSION['user_email'] = (string) $user['email'];

    set_flash('success', 'Signed in successfully.');
    redirect('/products.php');
}

$pageTitle = 'Sign In';
require_once __DIR__ . '/includes/header.php';
?>

<section class="wrap section auth-wrap">
    <h1>Sign In</h1>

    <form class="form auth-form" method="post" action="<?php echo url('signin.php'); ?>">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" required>

        <label for="password">Password</label>
        <input id="password" name="password" type="password" required>

        <button class="btn" type="submit">Sign In</button>
        <p class="small-note">New here? <a href="<?php echo url('signup.php'); ?>">Create an account</a>.</p>
    </form>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
