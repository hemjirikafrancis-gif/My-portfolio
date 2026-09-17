<?php
// ============================================================
// E.A.S. — Auth Helper
// ============================================================
if (session_status() === PHP_SESSION_NONE) session_start();

function isAdminLoggedIn(): bool {
    return isset($_SESSION['eas_admin_id']);
}

function requireAdmin(): void {
    if (!isAdminLoggedIn()) {
        header('Location: ../admin/login.php');
        exit;
    }
}

function adminLogin(string $username, string $password): bool {
    $pdo = getPDO();
    $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $admin = $stmt->fetch();
    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['eas_admin_id']   = $admin['id'];
        $_SESSION['eas_admin_name'] = $admin['full_name'];
        return true;
    }
    return false;
}

function adminLogout(): void {
    session_destroy();
    header('Location: login.php');
    exit;
}
