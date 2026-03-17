<?php
require_once __DIR__ . '/includes/bootstrap.php';

if (is_user_logged_in()) {
    redirect('/products.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = (string) ($_POST['password'] ?? '');
    $confirmPassword = (string) ($_POST['confirm_password'] ?? '');

    if ($fullName === '' || $email === '' || $password === '' || $confirmPassword === '') {
        set_flash('error', 'Please complete all fields.');
        redirect('/signup.php');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        set_flash('error', 'Please enter a valid email address.');
        redirect('/signup.php');
    }

    if (strlen($password) < 6) {
        set_flash('error', 'Password must be at least 6 characters.');
        redirect('/signup.php');
    }

    if ($password !== $confirmPassword) {
        set_flash('error', 'Passwords do not match.');
        redirect('/signup.php');
    }

    $check = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
    $check->execute([':email' => $email]);

    if ($check->fetch()) {
        set_flash('error', 'An account with this email already exists.');
        redirect('/signup.php');
    }

    $insert = $pdo->prepare('INSERT INTO users (full_name, email, password_hash) VALUES (:full_name, :email, :password_hash)');
    $insert->execute([
        ':full_name' => $fullName,
        ':email' => $email,
        ':password_hash' => password_hash($password, PASSWORD_DEFAULT),
    ]);

    $_SESSION['user_id'] = (int) $pdo->lastInsertId();
    $_SESSION['user_name'] = $fullName;
    $_SESSION['user_email'] = $email;

    set_flash('success', 'Account created successfully. Welcome!');
    redirect('/products.php');
}

$pageTitle = 'Sign Up';
require_once __DIR__ . '/includes/header.php';
?>

<section class="wrap section auth-wrap">
    <h1>Create Account</h1>

    <form class="form auth-form" method="post" action="<?php echo url('signup.php'); ?>">
        <label for="full_name">Full Name</label>
        <input id="full_name" name="full_name" type="text" required>

        <label for="email">Email</label>
        <input id="email" name="email" type="email" required>

        <label for="password">Password</label>
        <input id="password" name="password" type="password" minlength="6" required>

        <label for="confirm_password">Confirm Password</label>
        <input id="confirm_password" name="confirm_password" type="password" minlength="6" required>

        <button class="btn" type="submit">Sign Up</button>
        <p class="small-note">Already have an account? <a href="<?php echo url('signin.php'); ?>">Sign in here</a>.</p>
    </form>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
