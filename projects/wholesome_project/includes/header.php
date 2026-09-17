<?php
$page = $page ?? '';
$pageTitle = $pageTitle ?? 'Wholesome Legal House';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <!-- TOP BAR -->
  <div class="topbar">
    <div class="topbar-inner">
      <div class="topbar-contact">
        <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,12 2,6"/></svg> Office@wholesomelegal.com</span>
        <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8 19.79 19.79 0 01.22 1.18 2 2 0 012.22 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.09a16 16 0 006 6l.56-.56a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92v2z"/></svg> +234 805 517 3900</span>
        <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg> Km 1 Plaza, Airport Rd, Fagge, Kano</span>
      </div>
      <div class="topbar-social">
        <a href="https://www.facebook.com/Wholesome-legal-house-619429134774019/" target="_blank" aria-label="Facebook"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg></a>
        <a href="#" aria-label="Twitter"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg></a>
        <a href="#" aria-label="LinkedIn"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg></a>
      </div>
    </div>
  </div>

  <!-- MAIN NAV -->
  <header class="site-header" id="site-header">
    <div class="header-inner">
      <a href="index.php" class="logo">
        <img src="Images/cropped-headerlogo-1.png" alt="Wholesome Legal House" />
      </a>
      <button class="nav-toggle" id="nav-toggle" aria-label="Toggle menu">
        <span></span><span></span><span></span>
      </button>
      <nav class="main-nav" id="main-nav">
        <ul>
          <li><a href="index.php"   class="<?php echo $page==='home'?'active':''; ?>">Home</a></li>
          <li><a href="about.php"   class="<?php echo $page==='about'?'active':''; ?>">About Us</a></li>
          <li><a href="services.php" class="<?php echo $page==='services'?'active':''; ?>">Areas of Practice</a></li>
          <li><a href="clients.php" class="<?php echo $page==='clients'?'active':''; ?>">Clients</a></li>
          <li><a href="team.php"    class="<?php echo $page==='team'?'active':''; ?>">Team</a></li>
          <li><a href="blog.php"    class="<?php echo $page==='blog'?'active':''; ?>">Blog</a></li>
          <li><a href="articles.php" class="<?php echo $page==='articles'?'active':''; ?>">Articles</a></li>
          <li><a href="contact.php" class="<?php echo $page==='contact'?'active':''; ?>">Contact</a></li>
        </ul>
        <a href="contact.php" class="btn-consult">Free Consultation</a>
      </nav>
    </div>
  </header>
