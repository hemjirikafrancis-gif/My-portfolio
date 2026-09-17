<?php
require __DIR__ . '/../includes/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

function admin_logged_in() { return !empty($_SESSION['admin_id']); }

function require_admin() {
    if (!admin_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function csrf_token() {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));
    return $_SESSION['csrf'];
}

function csrf_check() {
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        die('Invalid request token.');
    }
}
