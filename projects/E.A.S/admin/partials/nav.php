<?php
$current = basename($_SERVER['PHP_SELF']);
$links = [
    'dashboard.php'   => ['Dashboard',    '📊'],
    'employees.php'   => ['Employees',    '👥'],
    'attendance.php'  => ['Attendance',   '📋'],
    'penalties.php'   => ['Penalty Rules','⚖️'],
    'reports.php'     => ['Reports',      '📈'],
];
?>
<nav class="sidebar">
  <div class="sidebar-brand">⏱ <span>E.A.S.</span></div>
  <ul class="nav-links">
    <?php foreach($links as $href => $info): ?>
    <li class="<?= $current === $href ? 'active' : '' ?>">
      <a href="<?= $href ?>"><?= $info[1] ?> <?= $info[0] ?></a>
    </li>
    <?php endforeach; ?>
  </ul>
  <div class="sidebar-footer">
    <div class="admin-name">👤 <?= htmlspecialchars($_SESSION['eas_admin_name'] ?? 'Admin') ?></div>
    <a href="logout.php" class="logout-link">Sign Out</a>
  </div>
</nav>
