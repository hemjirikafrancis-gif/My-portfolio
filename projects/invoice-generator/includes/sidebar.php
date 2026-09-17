<?php
$current = basename($_SERVER['PHP_SELF']);
$navItems = [
    ['href' => 'dashboard.php',      'icon' => 'fa-gauge-high',       'label' => 'Dashboard'],
    ['href' => 'invoices.php',       'icon' => 'fa-file-invoice',     'label' => 'Invoices'],
    ['href' => 'clients.php',        'icon' => 'fa-users',            'label' => 'Clients'],
    ['href' => 'create_invoice.php', 'icon' => 'fa-plus-circle',      'label' => 'New Invoice'],
];
$bottomItems = [
    ['href' => 'settings.php',  'icon' => 'fa-gear',  'label' => 'Settings'],
];
?>
<div class="sidebar-brand">
    <i class="fas fa-file-invoice-dollar brand-icon"></i>
    <span class="brand-name">InvoicePro</span>
</div>

<nav class="sidebar-nav">
    <?php foreach ($navItems as $item): ?>
    <a href="<?= $item['href'] ?>"
       class="nav-link <?= $current === $item['href'] ? 'active' : '' ?>">
        <i class="fas <?= $item['icon'] ?>"></i>
        <span><?= $item['label'] ?></span>
    </a>
    <?php endforeach; ?>
</nav>

<div class="sidebar-footer">
    <?php foreach ($bottomItems as $item): ?>
    <a href="<?= $item['href'] ?>"
       class="nav-link <?= $current === $item['href'] ? 'active' : '' ?>">
        <i class="fas <?= $item['icon'] ?>"></i>
        <span><?= $item['label'] ?></span>
    </a>
    <?php endforeach; ?>
</div>
