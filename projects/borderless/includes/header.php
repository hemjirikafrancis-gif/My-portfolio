<?php
$pageTitle = $pageTitle ?? 'Borderless Analysts';
$pageDesc  = $pageDesc  ?? 'Global insights and strategic excellence.';
$activeNav = $activeNav ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= e($pageTitle) ?></title>
  <meta name="description" content="<?= e($pageDesc) ?>" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="blog.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="blog-page">
  <div class="top-bar"><div class="top-bar-inner"><div class="top-bar-left"><a href="tel:+2348055336626"><i class="fa-solid fa-phone"></i> +234 805 533 6626</a><a href="tel:+447732034572"><i class="fa-solid fa-phone"></i> +44 773 203 4572</a></div><div class="top-bar-right"><a href="mailto:info@borderlessanalysts.com">✉ info@borderlessanalysts.com</a></div></div></div>

  <header class="site-header" id="site-header">
    <div class="header-inner">
      <a href="index.php" class="logo">
        <img src="images/borderles-analyst-logo.png" alt="Borderless Analysts Logo" class="site-logo-img">
      </a>
      <nav>
        <a href="index.php" class="nav-link">Home</a>
        <a href="about.php" class="nav-link">About Us</a>
        <div class="dropdown"><a href="services.php" class="nav-link dropdown-toggle">Services</a><div class="dropdown-menu"><a href="services.php#business-analysis">Business Analysis</a><a href="services.php#financial-analysis">Financial Analysis</a><a href="services.php#data-analysis">Data Analysis</a><a href="services.php#ai-automation">AI &amp; Automation</a></div></div>
        <div class="dropdown"><a href="#" class="nav-link dropdown-toggle <?= $activeNav === 'blog' ? 'active' : '' ?>">Insights &amp; Resources</a><div class="dropdown-menu"><a href="case-studies.php">Case Studies</a><a href="whitepapers.php">Whitepapers</a><a href="blog.php">News &amp; Blog</a></div></div>
        <a href="careers.php" class="nav-link">Careers</a>
        <a href="contact.php" class="nav-link">Contact Us</a>
      </nav>
      <a href="contact.php" class="btn btn-primary header-cta">Get Started</a>
      <button class="hamburger" id="hamburger"><span></span><span></span><span></span></button>
    </div>
  </header>

  <div class="mobile-overlay" id="mobile-menu">
    <div class="mobile-header"><div class="logo-text" style="color:#fff;">Borderless<br><span style="color:var(--accent)">Analysts</span></div><button class="mobile-close" id="mobile-close">&times;</button></div>
    <nav class="mobile-nav"><a href="index.php">Home</a><a href="about.php">About Us</a><a href="services.php">Services</a><a href="blog.php">Blog</a><a href="careers.php">Careers</a><a href="contact.php">Contact Us</a></nav>
    <div class="mobile-cta"><a href="contact.php" class="btn btn-primary" style="width:100%;justify-content:center;">Get Started</a></div>
  </div>
