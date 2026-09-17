<?php
/**
 * Floating pill navbar.
 * Links point to sections on the home page (index.php).
 */
?>
<nav class="navbar">
  <div class="nav-inner">
    <a href="index.php" class="logo">
      <span class="bracket">&lt;</span>F.H<span class="bracket">/&gt;</span>
      <span class="dot"></span>
    </a>

    <div class="nav-links">
      <a href="index.php#home">Home</a>
      <a href="about.php">About</a>
      <a href="index.php#skills">Skills</a>
      <a href="index.php#work">Work</a>
      <a href="index.php#services">Services</a>
      <a href="contact.php">Contact</a>
    </div>

    <div class="nav-cta">
      <a href="contact.php" class="btn btn-primary">Let's talk</a>
    </div>

    <button class="nav-toggle" aria-label="Toggle menu">
      <span></span><span></span><span></span>
    </button>
  </div>

  <div class="nav-drawer">
    <a href="index.php#home">Home</a>
    <a href="about.php">About</a>
    <a href="index.php#skills">Skills</a>
    <a href="index.php#work">Work</a>
    <a href="index.php#services">Services</a>
    <a href="contact.php">Contact</a>
    <a href="contact.php" class="btn btn-primary">Let's talk</a>
  </div>
</nav>
