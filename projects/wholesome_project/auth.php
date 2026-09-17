<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['admin_logged_in'])) {
    // works from any depth — compute root URL
    $scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    // walk up to project root (drop /dashboard, /dashboard/posts, etc.)
    $parts = explode('/', $scriptDir);
    while (!empty($parts) && end($parts) !== '' && in_array(end($parts), ['dashboard','posts','categories','testimonials'])) {
        array_pop($parts);
    }
    $root = implode('/', $parts);
    if ($root === '') { $root = '/'; }
    header('Location: ' . rtrim($root, '/') . '/admin-login.php');
    exit;
}
