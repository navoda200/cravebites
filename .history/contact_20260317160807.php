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

<section class="wrap section contact-section">
    <div class="contact-header">
        <h1>Get in Touch</h1>
        <p>Have questions or feedback? We'd love to hear from you. Drop us a message and we'll get back to you soon.</p>
    </div>

    <div class="contact-container">
        <div class="contact-form-container">
            <form class="contact-form" method="post" action="<?php echo url('contact.php'); ?>">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input id="full_name" name="full_name" type="text" placeholder="John Doe" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" name="email" type="email" placeholder="you@example.com" required>
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="6" placeholder="Tell us what's on your mind..." required></textarea>
                </div>

                <button class="btn btn-submit" type="submit">Send Message</button>
            </form>
        </div>

        <div class="contact-info-container">
            <div class="info-card">
                <div class="info-icon">📍</div>
                <h3>Location</h3>
                <p>123 Culinary Lane<br>Food City, FC 12345</p>
            </div>

            <div class="info-card">
                <div class="info-icon">📧</div>
                <h3>Email</h3>
                <p><a href="mailto:hello@cravebites.com">hello@cravebites.com</a></p>
            </div>

            <div class="info-card">
                <div class="info-icon">📱</div>
                <h3>Phone</h3>
                <p><a href="tel:+1234567890">+1 (234) 567-8900</a></p>
            </div>

            <div class="info-card">
                <div class="info-icon">⏰</div>
                <h3>Hours</h3>
                <p>Mon - Fri: 9AM - 6PM<br>Sat - Sun: 10AM - 4PM</p>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
