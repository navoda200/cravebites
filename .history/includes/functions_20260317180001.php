<?php
function escape(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function base_path(): string
{
    static $basePath = null;

    if ($basePath !== null) {
        return $basePath;
    }

    $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
    $dir = str_replace('\\', '/', dirname($scriptName));

    if ($dir === '.' || $dir === '/') {
        $dir = '';
    }

    $dir = rtrim($dir, '/');

    if (substr($dir, -6) === '/admin') {
        $dir = substr($dir, 0, -6);
    }

    $basePath = $dir;
    return $basePath;
}

function url(string $path = ''): string
{
    if (preg_match('#^https?://#i', $path)) {
        return $path;
    }

    $base = base_path();

    if ($path === '' || $path === '/') {
        return ($base !== '' ? $base : '') . '/';
    }

    return ($base !== '' ? $base : '') . '/' . ltrim($path, '/');
}

function redirect(string $path): void
{
    header('Location: ' . url($path));
    exit;
}

function set_flash(string $type, string $message): void
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
    ];
}

function get_flash(): ?array
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function is_admin_logged_in(): bool
{
    return !empty($_SESSION['admin_logged_in']);
}

function is_user_logged_in(): bool
{
    return !empty($_SESSION['user_id']);
}

function current_user_id(): int
{
    return (int) ($_SESSION['user_id'] ?? 0);
}

function current_user_name(): string
{
    return (string) ($_SESSION['user_name'] ?? '');
}

function require_user(): void
{
    if (!is_user_logged_in()) {
        set_flash('error', 'Please sign in to continue.');
        redirect('/signin.php');
    }
}

function require_admin(): void
{
    if (!is_admin_logged_in()) {
        set_flash('error', 'Please login to access the admin panel.');
        redirect('/admin/login.php');
    }
}

function lkr_rate(): float
{
    return 320.0;
}

function to_lkr(float $basePrice): float
{
    return $basePrice * lkr_rate();
}

function to_base_from_lkr(float $lkrPrice): float
{
    return $lkrPrice / lkr_rate();
}

function format_price(float $price): string
{
    return number_format(to_lkr($price), 0);
}

function format_price_input_lkr(float $price): string
{
    return number_format(to_lkr($price), 2, '.', '');
}

function cart_item_count(PDO $pdo, int $userId): int
{
    $stmt = $pdo->prepare('SELECT COALESCE(SUM(quantity), 0) FROM cart_items WHERE user_id = :user_id');
    $stmt->execute([':user_id' => $userId]);
    return (int) $stmt->fetchColumn();
}
