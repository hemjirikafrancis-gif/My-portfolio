<?php
/* Shared header. The including page should set, before requiring this file:
     $is_home          bool  – true only for index.php
     $page_title       string
     $page_description string
*/
if (!isset($is_home)) { $is_home = false; }
if (!isset($page_title)) { $page_title = "ALIRA Farm — Integrated Poultry Agribusiness"; }
if (!isset($page_description)) {
    $page_description = "ALIRA Farm is an integrated poultry agribusiness building Nigeria's leading farm-to-fork poultry brand.";
}
/* $home is the prefix nav links need: empty on the homepage (plain #anchors),
   "index.php" on every other page (so links jump home, then to the anchor). */
$home = $is_home ? '' : 'index.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="grain-overlay" aria-hidden="true"></div>

    <!-- ============ NAV ============ -->
    <header class="site-header" id="top">
        <div class="header-inner">
            <a href="<?php echo $home !== '' ? $home : '#top'; ?>" class="brand">
                <span class="brand-mark">
                    <img src="images/alira-logo.jpeg" alt="ALIRA Farm logo">
                </span>
                <span class="brand-text">
                    <span class="brand-name">ALIRA <em>Farm</em></span>
                    <span class="brand-sub">Integrated Poultry Agribusiness</span>
                </span>
            </a>

            <nav class="main-nav" id="main-nav">
                <a href="<?php echo $home; ?>#about" class="nav-link">About</a>
                <a href="<?php echo $home; ?>#vision" class="nav-link">Vision &amp; Mission</a>
                <a href="<?php echo $home; ?>#goals" class="nav-link">Goals</a>
                <a href="<?php echo $home; ?>#products" class="nav-link">Products</a>
                <a href="<?php echo $home; ?>#clients" class="nav-link">Clients</a>
                <a href="<?php echo $home; ?>#structure" class="nav-link">Structure</a>
                <a href="<?php echo $home; ?>#contact" class="nav-link nav-cta">Get in Touch</a>
            </nav>

            <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </header>
