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

function require_admin(): void
{
    if (!is_admin_logged_in()) {
        set_flash('error', 'Please login to access the admin panel.');
        redirect('/admin/login.php');
    }
}

function format_price(float $price): string
{
    return number_format($price, 2);
}
