<?php
require __DIR__ . '/includes/db.php';

$q   = trim($_GET['q'] ?? '');
$cat = isset($_GET['cat']) && $_GET['cat'] !== '' ? (int)$_GET['cat'] : 0;

$categories = $pdo->query(
    "SELECT c.id, c.name, COUNT(p.id) AS total
     FROM categories c LEFT JOIN posts p ON p.category_id = c.id
     GROUP BY c.id, c.name ORDER BY c.name"
)->fetchAll();

$where = [];
$args  = [];
if ($q !== '') {
    $where[] = '(p.title LIKE ? OR p.content LIKE ?)';
    $args[]  = "%$q%";
    $args[]  = "%$q%";
}
if ($cat) {
    $where[] = 'p.category_id = ?';
    $args[]  = $cat;
}
$sql = "SELECT p.*, c.name AS category
        FROM posts p LEFT JOIN categories c ON c.id = p.category_id"
     . ($where ? ' WHERE ' . implode(' AND ', $where) : '')
     . ' ORDER BY p.featured DESC, p.created_at DESC';
$stmt = $pdo->prepare($sql);
$stmt->execute($args);
$posts = $stmt->fetchAll();

$recent = $pdo->query(
    "SELECT title, slug, created_at FROM posts ORDER BY created_at DESC LIMIT 4"
)->fetchAll();

$featured = null;
if ($q === '' && !$cat && $posts) {
    $featured = array_shift($posts);
}

$activeCatName = '';
foreach ($categories as $c) { if ($c['id'] == $cat) $activeCatName = $c['name']; }

$pageTitle = 'News & Blog – Borderless Analysts';
$pageDesc  = 'Expert insights, industry trends and practical guidance from the Borderless Analysts team.';
$activeNav = 'blog';
require __DIR__ . '/includes/header.php';
?>

  <section class="page-hero">
    <div class="container"><div class="page-hero-content">
      <div class="breadcrumb"><a href="index.php">Home</a><span>›</span><span>News &amp; Blog</span></div>
      <h1>News &amp; Blog</h1>
      <p>Expert insights, industry trends, and practical guidance from the Borderless Analysts team — helping you stay ahead in a rapidly changing business world.</p>
    </div></div>
  </section>

  <section class="blog-main">
    <div class="container">

      <!-- SEARCH + CATEGORY FILTER BAR -->
      <form class="blog-toolbar" method="get" action="blog.php">
        <div class="blog-search">
          <input type="text" name="q" value="<?= e($q) ?>" placeholder="Search articles, topics, keywords…" />
          <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
        </div>
        <div class="blog-chips">
          <a class="chip <?= $cat ? '' : 'active' ?>" href="blog.php<?= $q !== '' ? '?q=' . urlencode($q) : '' ?>">All</a>
          <?php foreach ($categories as $c): ?>
            <a class="chip <?= $cat === (int)$c['id'] ? 'active' : '' ?>"
               href="blog.php?cat=<?= (int)$c['id'] ?><?= $q !== '' ? '&q=' . urlencode($q) : '' ?>">
              <?= e($c['name']) ?><small><?= (int)$c['total'] ?></small>
            </a>
          <?php endforeach; ?>
        </div>
      </form>

      <div class="blog-layout">
        <div>
          <?php if ($q !== '' || $cat): ?>
            <p class="blog-result-line">
              <?= count($posts) ?> article<?= count($posts) === 1 ? '' : 's' ?>
              <?= $q !== '' ? 'matching “' . e($q) . '”' : '' ?>
              <?= $activeCatName ? 'in ' . e($activeCatName) : '' ?>
              — <a href="blog.php" style="color:var(--accent);font-weight:600;">clear filters</a>
            </p>
          <?php endif; ?>

          <?php if ($featured): ?>
            <article class="blog-featured fade-up">
              <div class="blog-featured-thumb">
                <?php if (!empty($featured['image'])): ?>
                  <img src="<?= e($featured['image']) ?>" alt="<?= e($featured['title']) ?>">
                <?php else: ?>🤖<?php endif; ?>
              </div>
              <div class="blog-featured-body">
                <span class="blog-tag"><?= e($featured['category'] ?? 'Insights') ?></span>
                <h2><a href="post.php?slug=<?= e($featured['slug']) ?>"><?= e($featured['title']) ?></a></h2>
                <p><?= e(excerpt($featured['content'], 300)) ?></p>
                <div class="blog-meta">
                  <span>👤 <?= e($featured['author']) ?></span>
                  <span>📅 <?= date('j M Y', strtotime($featured['created_at'])) ?></span>
                </div>
              </div>
            </article>
          <?php endif; ?>

          <?php if (!$posts && !$featured): ?>
            <div class="empty-state">
              <h3>No articles found</h3>
              <p>Try a different keyword or browse another category.</p>
            </div>
          <?php endif; ?>

          <div class="blog-list">
            <?php foreach ($posts as $p): ?>
              <article class="blog-list-card fade-up">
                <div class="blog-list-thumb">
                  <?php if (!empty($p['image'])): ?>
                    <img src="<?= e($p['image']) ?>" alt="<?= e($p['title']) ?>">
                  <?php else: ?>📊<?php endif; ?>
                </div>
                <div class="blog-list-body">
                  <span class="blog-tag"><?= e($p['category'] ?? 'Insights') ?></span>
                  <h3><a href="post.php?slug=<?= e($p['slug']) ?>"><?= e($p['title']) ?></a></h3>
                  <p><?= e(excerpt($p['content'])) ?></p>
                  <div class="blog-meta">
                    <span>👤 <?= e($p['author']) ?></span>
                    <span>📅 <?= date('j M Y', strtotime($p['created_at'])) ?></span>
                  </div>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </div>

        <aside class="sidebar">
          <div class="sidebar-widget">
            <h4>Categories</h4>
            <div class="sidebar-cats">
              <?php foreach ($categories as $c): ?>
                <a class="sidebar-cat" href="blog.php?cat=<?= (int)$c['id'] ?>">
                  <?= e($c['name']) ?> <span><?= (int)$c['total'] ?></span>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="sidebar-widget">
            <h4>Recent Posts</h4>
            <div class="sidebar-recent">
              <?php foreach ($recent as $r): ?>
                <div class="sidebar-post">
                  <div class="sidebar-post-icon">📰</div>
                  <div>
                    <h5><a href="post.php?slug=<?= e($r['slug']) ?>"><?= e($r['title']) ?></a></h5>
                    <p><?= date('F Y', strtotime($r['created_at'])) ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="sidebar-widget newsletter-widget">
            <h4>Newsletter</h4>
            <p>Get the latest insights delivered directly to your inbox every month.</p>
            <input type="email" placeholder="Your email address" />
            <button class="btn btn-primary">Subscribe →</button>
          </div>
          <div class="sidebar-widget">
            <h4>Quick Links</h4>
            <div class="footer-links">
              <a href="case-studies.php">📁 Case Studies</a>
              <a href="whitepapers.php">📄 Whitepapers</a>
              <a href="services.php"><i class="fa-solid fa-gear"></i> Our Services</a>
              <a href="contact.php"><i class="fa-solid fa-envelope"></i> Contact Us</a>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </section>

<?php require __DIR__ . '/includes/footer.php'; ?>
