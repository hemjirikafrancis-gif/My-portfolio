<?php
// Reusable small page hero
$ph_title = $ph_title ?? '';
$ph_sub   = $ph_sub ?? '';
$ph_crumb = $ph_crumb ?? $ph_title;
$ph_image = $ph_image ?? 'Images/Blog-1.png';
?>
<section class="page-hero" style="background-image:linear-gradient(rgba(30,20,10,0.7),rgba(30,20,10,0.75)),url('<?php echo htmlspecialchars($ph_image); ?>');">
  <div class="container">
    <p class="hero-sub"><?php echo htmlspecialchars($ph_sub); ?></p>
    <h1><?php echo $ph_title; ?></h1>
    <nav class="crumbs"><a href="index.php">Home</a> <span>/</span> <span><?php echo htmlspecialchars($ph_crumb); ?></span></nav>
  </div>
</section>
