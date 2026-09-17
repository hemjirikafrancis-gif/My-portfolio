<?php
require __DIR__ . '/includes/db.php';

$slug = $_GET['slug'] ?? '';
$stmt = $pdo->prepare("SELECT p.*, c.name AS category FROM posts p
                       LEFT JOIN categories c ON c.id = p.category_id
                       WHERE p.slug = ? LIMIT 1");
$stmt->execute([$slug]);
$post = $stmt->fetch();

if (!$post) {
    http_response_code(404);
    $pageTitle = 'Article not found – Borderless Analysts';
    require __DIR__ . '/includes/header.php';
    echo '<section class="blog-main"><div class="container"><div class="empty-state">
          <h3>Article not found</h3><p>The article you are looking for does not exist or has been removed.</p>
          <p style="margin-top:18px"><a class="btn btn-primary" href="blog.php">Back to blog</a></p></div></div></section>';
    require __DIR__ . '/includes/footer.php';
    exit;
}

$more = $pdo->prepare("SELECT title, slug FROM posts WHERE id <> ? ORDER BY created_at DESC LIMIT 4");
$more->execute([$post['id']]);
$more = $more->fetchAll();

$pageTitle = $post['title'] . ' – Borderless Analysts';
$pageDesc  = excerpt($post['content'], 150);
$activeNav = 'blog';
require __DIR__ . '/includes/header.php';
?>
  <section class="page-hero">
    <div class="container"><div class="page-hero-content">
      <div class="breadcrumb"><a href="index.php">Home</a><span>›</span><a href="blog.php">News &amp; Blog</a><span>›</span><span><?= e($post['category'] ?? 'Article') ?></span></div>
      <h1><?= e($post['title']) ?></h1>
    </div></div>
  </section>

  <section class="blog-main">
    <div class="container">
      <article class="post-wrap">
        <?php if (!empty($post['image'])): ?>
          <div class="post-cover"><img src="<?= e($post['image']) ?>" alt="<?= e($post['title']) ?>"></div>
        <?php endif; ?>
        <div class="post-body">
          <span class="blog-tag"><?= e($post['category'] ?? 'Insights') ?></span>
          <h1><?= e($post['title']) ?></h1>
          <div class="blog-meta">
            <span>👤 <?= e($post['author']) ?></span>
            <span>📅 <?= date('j F Y', strtotime($post['created_at'])) ?></span>
          </div>
          <div class="post-content"><?= nl2br(e($post['content'])) ?></div>
          <p style="margin-top:34px"><a class="btn btn-primary" href="blog.php">← Back to all articles</a></p>
        </div>
      </article>

      <?php if ($more): ?>
        <div class="post-wrap" style="margin-top:28px;padding:30px 40px;">
          <h4 style="margin-bottom:14px;">More articles</h4>
          <div class="footer-links">
            <?php foreach ($more as $m): ?>
              <a href="post.php?slug=<?= e($m['slug']) ?>">📰 <?= e($m['title']) ?></a>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>
<?php require __DIR__ . '/includes/footer.php'; ?>
