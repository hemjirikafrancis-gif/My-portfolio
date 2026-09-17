<?php
// Admin layout partial — opens HTML, sidebar, topbar. Page must include includes/admin-footer.php at the end.
require_once __DIR__ . '/../../auth.php';

// Compute base URL prefix to project root from /dashboard/<...>/file.php
$scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$parts = explode('/', $scriptDir);
$depth = 0;
while (!empty($parts) && in_array(end($parts), ['posts','categories','testimonials'])) { array_pop($parts); $depth++; }
// depth is dashboard subfolder depth (0 if directly in /dashboard)
$ROOT = str_repeat('../', $depth + 1); // back to project root from /dashboard/(sub)/file
$DASH = $ROOT . 'dashboard/';

$active = $active ?? '';
$adminTitle = $adminTitle ?? 'Dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($adminTitle); ?> – Wholesome Legal Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo $ROOT; ?>style.css" />
</head>
<body class="admin-body">
  <aside class="admin-sidebar">
    <a href="<?php echo $ROOT; ?>index.php" class="admin-logo">
      <img src="<?php echo $ROOT; ?>Images/cropped-headerlogo-1.png" alt="Wholesome Legal House" />
    </a>
    <p class="admin-brand-sub">Admin Panel</p>

    <nav class="admin-nav">
      <a href="<?php echo $DASH; ?>index.php" class="<?php echo $active==='dashboard'?'active':''; ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
        Dashboard
      </a>
      <a href="<?php echo $DASH; ?>posts/index.php" class="<?php echo $active==='posts'?'active':''; ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        Posts
      </a>
      <a href="<?php echo $DASH; ?>categories/index.php" class="<?php echo $active==='categories'?'active':''; ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/></svg>
        Categories
      </a>
      <a href="<?php echo $DASH; ?>testimonials/index.php" class="<?php echo $active==='testimonials'?'active':''; ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
        Testimonials
      </a>
      <a href="<?php echo $ROOT; ?>blog.php" target="_blank">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        View Site
      </a>
    </nav>

    <a href="<?php echo $ROOT; ?>logout.php" class="admin-logout">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
      Logout
    </a>
  </aside>

  <main class="admin-main">
    <header class="admin-topbar">
      <h1><?php echo htmlspecialchars($adminTitle); ?></h1>
      <div class="admin-user">
        <span>Welcome, <strong>Admin</strong></span>
        <div class="admin-avatar">A</div>
      </div>
    </header>
    <div class="admin-content">
