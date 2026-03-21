<?php
$host = getenv('DB_HOST') ?: 'sql303.infinityfree.com';
$dbName = getenv('DB_NAME') ?: 'if0_41444636_cravebitesdb';
$user = getenv('DB_USER') ?: 'if0_41444636';
$pass = getenv('DB_PASS') ?: 'YOUR_VPANEL_PASSWORD';
$port = getenv('DB_PORT') ?: '3306';

$dsn = "mysql:host={$host};port={$port};dbname={$dbName};charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}