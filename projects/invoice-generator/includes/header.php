<?php
// Ensure session + auth are always started
if (session_status() === PHP_SESSION_NONE) session_start();
if (!function_exists('isLoggedIn')) {
    require_once __DIR__ . '/auth.php';
}
if (!function_exists('flashMessage')) {
    require_once __DIR__ . '/functions.php';
}

$pageTitle = $pageTitle ?? 'InvoicePro';
$user = function_exists('getCurrentUser') && isset($pdo) ? getCurrentUser($pdo) : ($_SESSION['user'] ?? []);
$currency = $user['currency_symbol'] ?? '$';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> | InvoicePro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/invoice-generator/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="<?= isLoggedIn() ? 'app-layout' : 'auth-layout' ?>">

<?php if (isLoggedIn()): ?>
<div class="app-wrapper">
    <aside class="sidebar" id="sidebar">
        <?php
        $current = basename($_SERVER['PHP_SELF']);
        $navItems = [
            ['href'=>'dashboard.php',      'icon'=>'fa-gauge-high',   'label'=>'Dashboard'],
            ['href'=>'invoices.php',        'icon'=>'fa-file-invoice', 'label'=>'Invoices'],
            ['href'=>'clients.php',         'icon'=>'fa-users',        'label'=>'Clients'],
            ['href'=>'create_invoice.php',  'icon'=>'fa-plus-circle',  'label'=>'New Invoice'],
        ];
        $bottomItems = [
            ['href'=>'settings.php','icon'=>'fa-gear','label'=>'Settings'],
        ];
        ?>
        <div class="sidebar-brand">
            <div class="brand-icon"><i class="fas fa-file-invoice-dollar"></i></div>
            <span class="brand-name">InvoicePro</span>
        </div>
        <nav class="sidebar-nav">
            <?php foreach ($navItems as $item): ?>
            <a href="/invoice-generator/<?= $item['href'] ?>"
               class="nav-item <?= $current === $item['href'] ? 'active' : '' ?>">
                <span class="nav-icon"><i class="fas <?= $item['icon'] ?>"></i></span>
                <span><?= $item['label'] ?></span>
            </a>
            <?php endforeach; ?>
        </nav>
        <div class="sidebar-footer">
            <div class="user-avatar"><?= strtoupper(substr($user['name'] ?? 'U', 0, 1)) ?></div>
            <div class="user-meta">
                <span class="user-name"><?= htmlspecialchars($user['name'] ?? '') ?></span>
                <span class="user-role">Administrator</span>
            </div>
            <?php foreach ($bottomItems as $item): ?>
            <a href="/invoice-generator/<?= $item['href'] ?>" class="nav-item <?= $current === $item['href'] ? 'active' : '' ?>" title="<?= $item['label'] ?>">
                <i class="fas <?= $item['icon'] ?>"></i>
            </a>
            <?php endforeach; ?>
            <a href="/invoice-generator/logout.php" class="logout-btn" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    </aside>
    <div class="page-body">
        <header class="topbar">
            <button class="menu-btn" id="menuBtn" aria-label="Toggle menu">
                <i class="fas fa-bars"></i>
            </button>
            <div class="topbar-right">
                <span class="topbar-greeting">Welcome, <?= htmlspecialchars($user['name'] ?? 'User') ?></span>
            </div>
        </header>
        <main class="main-content">
            <?php flashMessage(); ?>
<?php else: ?>
<div class="auth-wrapper">
<?php endif; ?>
