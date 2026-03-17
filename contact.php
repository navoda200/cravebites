<?php
require_once __DIR__ . '/includes/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($fullName === '' || $email === '' || $message === '') {
        set_flash('error', 'All fields are required.');
        redirect('/contact.php');
    }

    $stmt = $pdo->prepare('INSERT INTO contacts (full_name, email, message) VALUES (:full_name, :email, :message)');
    $stmt->execute([
        ':full_name' => $fullName,
        ':email' => $email,
        ':message' => $message,
    ]);

    set_flash('success', 'Thank you! Your message has been submitted.');
    redirect('/contact.php');
}

$pageTitle = 'Contact';
require_once __DIR__ . '/includes/header.php';
?>

<section class="wrap section">
    <div class="section-head">
        <h1>Contact Us</h1>
        <p>We would love to hear your feedback and questions.</p>
    </div>

    <form class="form" method="post" action="<?php echo url('contact.php'); ?>">
        <label for="full_name">Full Name</label>
        <input id="full_name" name="full_name" type="text" required>

        <label for="email">Email</label>
        <input id="email" name="email" type="email" required>

        <label for="message">Message</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <button class="btn" type="submit">Submit</button>
    </form>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
