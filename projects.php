<?php
$pageTitle = 'Projects';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- ======================= PAGE HERO ======================= -->
<section class="page-hero">
  <div class="container">
    <div class="eyebrow">// All Projects</div>
    <h1>Everything I've built, end to end.</h1>
    <p>Client sites and personal builds. Click any card to open the live project in a new tab.</p>
  </div>
</section>

<!-- ======================= ALL PROJECTS ======================= -->
<section class="work">
  <div class="container">
    <div class="work-grid">

      <a href="projects/Alira%20Farm%20-%20Multi-Page/index.php" target="_blank" rel="noopener noreferrer" class="work-card span-4 reveal">
        <img src="images/work/alira-farm.jpeg" alt="Alira Farm website screenshot">
        <div class="work-body">
          <span class="work-tag">Agriculture</span>
          <h3>Alira Farm</h3>
          <p>Grew from a single landing page into a full six-section, multi-page site with custom photo layouts and a contact form wired to MySQL.</p>
          <div class="work-stack"><span>HTML</span><span>CSS</span><span>PHP</span><span>MySQL</span></div>
        </div>
      </a>

      <a href="projects/GREEN-CROSS-2/index.html" target="_blank" rel="noopener noreferrer" class="work-card span-2 reveal">
        <img src="images/work/green-cross.jpg" alt="Green Cross Pharmacy screenshot">
        <div class="work-body">
          <span class="work-tag">Pharmacy</span>
          <h3>Green Cross Pharmacy</h3>
          <p>Rebuilt from a broken template &mdash; fixed contact routing, repaired the mail system, restyled around green &amp; gold.</p>
          <div class="work-stack"><span>PHP</span><span>PHPMailer</span></div>
        </div>
      </a>

      <a href="projects/Hemjirika%27s%20Pharmacueticals/index.php" target="_blank" rel="noopener noreferrer" class="work-card span-2 reveal">
        <img src="images/work/hemjirika.jpg" alt="Hemjirika's Pharmaceuticals screenshot">
        <div class="work-body">
          <span class="work-tag">Pharmaceutical</span>
          <h3>Hemjirika's Pharmaceuticals</h3>
          <p>Built from scratch with prescription uploads, compliance pages, and a blog journal on a shared data layer.</p>
          <div class="work-stack"><span>PHP</span><span>MySQL</span><span>JS</span></div>
        </div>
      </a>

      <a href="projects/borderless/index.php" target="_blank" rel="noopener noreferrer" class="work-card span-4 reveal">
        <img src="images/work/borderless.jpg" alt="Borderless Analysts screenshot">
        <div class="work-body">
          <span class="work-tag">Consulting</span>
          <h3>Borderless Analysts</h3>
          <p>A ten-page consulting site translating AI-automation services into copy people without a technical background could actually follow.</p>
          <div class="work-stack"><span>PHP</span><span>HTML</span><span>CSS</span><span>JS</span></div>
        </div>
      </a>

      <a href="projects/wholesome_project/index.php" target="_blank" rel="noopener noreferrer" class="work-card span-6 reveal">
        <img src="images/work/wholesome-legal.jpg" alt="Wholesome Legal House screenshot">
        <div class="work-body">
          <span class="work-tag">Legal</span>
          <h3>Wholesome Legal House</h3>
          <p>An ongoing law-firm platform with a full blog CMS, a testimonial approval workflow, and an admin panel to manage all of it.</p>
          <div class="work-stack"><span>PHP</span><span>MySQL</span><span>Admin CMS</span></div>
        </div>
      </a>

      <a href="projects/E.A.S/index.php" target="_blank" rel="noopener noreferrer" class="work-card no-image span-3 reveal">
        <div class="work-body">
          <span class="work-tag">Internal Tool</span>
          <h3>Employee Attendance System</h3>
          <p>A clock-in/clock-out terminal with PIN login, a late-penalty engine, and an admin panel with monthly deduction reports.</p>
          <div class="work-stack"><span>PHP</span><span>MySQL</span></div>
        </div>
      </a>

      <a href="projects/invoice-generator/index.php" target="_blank" rel="noopener noreferrer" class="work-card no-image span-3 reveal">
        <div class="work-body">
          <span class="work-tag">Utility</span>
          <h3>Invoice Generator</h3>
          <p>A small PHP tool for putting together and exporting clean, professional client invoices without opening a spreadsheet.</p>
          <div class="work-stack"><span>PHP</span></div>
        </div>
      </a>

    </div>
  </div>
</section>

<div class="seam">
  <svg viewBox="0 0 1440 64" preserveAspectRatio="none">
    <path d="M0,28 C260,-8 500,70 780,26 C1040,-10 1240,68 1440,32"></path>
    <circle class="seam-dot" r="3.5" style="offset-path:path('M0,28 C260,-8 500,70 780,26 C1040,-10 1240,68 1440,32')"></circle>
  </svg>
</div>

<!-- ======================= CTA ======================= -->
<section class="contact">
  <div class="container" style="text-align:center;">
    <div class="eyebrow" style="justify-content:center;">// Next</div>
    <h2 style="margin-bottom:18px;">Got a project in mind?</h2>
    <p style="max-width:560px; margin:0 auto 34px; color:var(--muted-400);">
      Tell me what you're trying to build, and I'll tell you what it'd take to get there.
    </p>
    <a href="contact.php" class="btn btn-primary">Get in touch</a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
