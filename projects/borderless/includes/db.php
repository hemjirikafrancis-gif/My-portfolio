<?php
/**
 * Database connection (MySQL / MariaDB).
 * Edit these values to match your hosting environment.
 */
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'borderless_blog');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die('Database connection failed. Please import database.sql and check includes/db.php. (' . htmlspecialchars($e->getMessage()) . ')');
}

function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

function slugify($text) {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-') ?: 'post-' . time();
}

function excerpt($html, $len = 180) {
    $t = trim(preg_replace('/\s+/', ' ', strip_tags($html)));
    return mb_strlen($t) > $len ? mb_substr($t, 0, $len) . '…' : $t;
}
