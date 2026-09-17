<?php
/**
 * includes/header.php
 * Shared <head> + site navigation, included by every page.
 *
 * Expects the including page to optionally define, BEFORE requiring this file:
 *   $pageTitle        string  e.g. "About Us"
 *   $pageDescription  string  meta description, ~150-160 chars
 *   $canonicalPath     string  e.g. "/about.php"  (used to build canonical + OG url)
 *
 * Edit $siteUrl below once the site has a live domain.
 */

$siteName        = "Hemjirika's Pharmaceuticals";
$siteUrl         = "https://www.hemjirikas.com"; // TODO: replace with live domain
$defaultTitle    = "Hemjirika's Pharmaceuticals — Research-Driven Medicines, Made in Nigeria";
$defaultDesc     = "Hemjirika's Pharmaceuticals researches, manufactures and distributes quality-assured medicines from Nigeria, guided by rigorous science and an unwavering ethics standard.";

$pageTitle       = isset($pageTitle) ? $pageTitle . " — " . $siteName : $defaultTitle;
$pageDescription = isset($pageDescription) ? $pageDescription : $defaultDesc;
$canonicalPath   = isset($canonicalPath) ? $canonicalPath : "/index.php";
$canonicalUrl    = $siteUrl . $canonicalPath;

// Used to highlight the right nav item on internal pages
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($pageTitle); ?></title>
<meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
<meta name="robots" content="index, follow">
<link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">

<!-- Open Graph / social sharing -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?php echo htmlspecialchars($siteName); ?>">
<meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
<meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
<meta property="og:image" content="<?php echo htmlspecialchars($siteUrl); ?>/assets/images/og-cover.jpg">
<meta name="twitter:card" content="summary_large_image">

<!-- Favicon (inline SVG — replace with a branded icon file when ready) -->
<link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='18' fill='%230E1B36'/><text x='50' y='66' font-size='52' text-anchor='middle' fill='%23C68A2E' font-family='Georgia,serif'>H</text></svg>">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,500&family=Fraunces:opsz,wght@9..144,300;9..144,500;9..144,600;9..144,700&family=Inter:wght@300;400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

<!-- Structured data: Organization -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Hemjirika's Pharmaceuticals",
  "url": "<?php echo $siteUrl; ?>",
  "description": "<?php echo htmlspecialchars($defaultDesc); ?>",
  "department": [
    { "@type": "Organization", "name": "Research & Development" },
    { "@type": "Organization", "name": "Production (Manufacturing)" },
    { "@type": "Organization", "name": "Quality Assurance & Quality Control" },
    { "@type": "Organization", "name": "Sales & Marketing" }
  ]
}
</script>
</head>
<body>

<header class="site-header">
  <div class="container">
    <a href="index.php" class="brand">
      <span class="brand-mark">Hemjirika's</span> Pharmaceuticals
      <span class="brand-suffix">Nigeria</span>
    </a>

    <nav class="main-nav" aria-label="Primary">
      <div class="nav-menu" id="nav-menu">
        <ul class="nav-links">
          <li><a href="index.php#about">About</a></li>
          <li><a href="index.php#departments">Departments</a></li>
          <li><a href="index.php#categories">Categories</a></li>
          <li><a href="index.php#compliance">Compliance</a></li>
          <li><a href="blog.php">Journal</a></li>
          <li><a href="index.php#contact">Contact</a></li>
        </ul>
        <a href="prescription.php" class="btn btn-accent nav-rx-btn">
          <svg class="btn-icon" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M10 3v14M3 10h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
          Upload Prescription
        </a>
      </div>
      <button class="nav-toggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="nav-menu">
        <span></span><span></span><span></span>
      </button>
    </nav>
  </div>
</header>
