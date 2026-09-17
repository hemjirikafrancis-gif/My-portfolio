<?php
$page='articles';
$pageTitle='Legal Articles – Wholesome Legal House';
include 'includes/header.php';
include 'includes/articles.php';

$ph_title = 'Legal <em>Articles</em>';
$ph_sub   = 'Insights & Publications';
$ph_crumb = 'Articles';
$ph_image = 'Images/Blog-1.png';
include 'includes/page-hero.php';
?>

<section class="articles-section">
  <div class="container">
    <div class="section-header">
      <span class="section-label light">Publications</span>
      <h2>Browse Our <em>Legal Articles</em></h2>
      <p>Download and read practical analyses from our team on evolving areas of Nigerian law.</p>
    </div>

    <div class="articles-grid">
      <?php foreach ($articles as $a): ?>
        <article class="article-card">
          <div class="article-icon">
            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
              <polyline points="14 2 14 8 20 8"/>
              <line x1="9" y1="13" x2="15" y2="13"/>
              <line x1="9" y1="17" x2="15" y2="17"/>
            </svg>
          </div>
          <span class="article-cat"><?php echo htmlspecialchars($a['category']); ?></span>
          <h4><?php echo htmlspecialchars($a['title']); ?></h4>
          <div class="article-actions">
            <a href="articles/<?php echo rawurlencode($a['file']); ?>" target="_blank" rel="noopener" class="article-link">
              Read
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
            <a href="articles/<?php echo rawurlencode($a['file']); ?>" download class="article-download" aria-label="Download PDF">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
