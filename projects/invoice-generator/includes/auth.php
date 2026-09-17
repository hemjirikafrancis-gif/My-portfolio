<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn(): bool {
    return isset($_SESSION['user_id']);
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        header("Location: index.php");
        exit;
    }
}

function currentUser(): array {
    return $_SESSION['user'] ?? [];
}

function loginUser(array $user): void {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user']    = $user;
}

function logoutUser(): void {
    $_SESSION = [];
    session_destroy();
}
