<?php
require __DIR__ . '/includes/blog-data.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$post = null;
foreach ($blogPosts as $p) {
  if ($p['slug'] === $slug) { $post = $p; break; }
}

// Unknown or missing slug — send the reader to the full Journal listing
if (!$post) {
  header("Location: blog.php");
  exit;
}

$pageTitle       = $post['title'];
$pageDescription = $post['excerpt'];
$canonicalPath   = "/blog-post.php?slug=" . urlencode($post['slug']);
require __DIR__ . '/includes/header.php';

// Build a "more from the Journal" strip — up to 3 other posts
$related = [];
foreach ($blogPosts as $p) {
  if ($p['slug'] !== $post['slug']) $related[] = $p;
  if (count($related) === 3) break;
}
?>

<main>

  <article class="article-page">

    <section class="page-hero article-hero">
      <div class="container">
        <p class="breadcrumb"><a href="index.php">Home</a> / <a href="blog.php">Journal</a> / <?php echo htmlspecialchars($post['title']); ?></p>
        <span class="eyebrow"><?php echo htmlspecialchars($post['category']); ?></span>
        <h1><?php echo htmlspecialchars($post['title']); ?></h1>
        <div class="article-meta">
          <span><?php echo htmlspecialchars($post['author']); ?></span>
          <span aria-hidden="true">·</span>
          <span><?php echo htmlspecialchars($post['date']); ?></span>
          <span aria-hidden="true">·</span>
          <span><?php echo htmlspecialchars($post['read']); ?></span>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container article-layout">

        <figure class="article-cover" data-reveal>
          <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" loading="lazy">
        </figure>

        <div class="article-body" data-reveal data-reveal-delay="80">
          <p class="article-lede"><?php echo htmlspecialchars($post['excerpt']); ?></p>

          <?php foreach ($post['body'] as $block): ?>
            <?php if ($block['type'] === 'p'): ?>
              <p><?php echo htmlspecialchars($block['text']); ?></p>

            <?php elseif ($block['type'] === 'h2'): ?>
              <h2><?php echo htmlspecialchars($block['text']); ?></h2>

            <?php elseif ($block['type'] === 'ul'): ?>
              <ul>
                <?php foreach ($block['items'] as $item): ?>
                  <li><?php echo htmlspecialchars($item); ?></li>
                <?php endforeach; ?>
              </ul>

            <?php elseif ($block['type'] === 'quote'): ?>
              <blockquote class="article-quote">
                <p>&ldquo;<?php echo htmlspecialchars($block['text']); ?>&rdquo;</p>
                <?php if (!empty($block['attribution'])): ?>
                  <cite>&mdash; <?php echo htmlspecialchars($block['attribution']); ?></cite>
                <?php endif; ?>
              </blockquote>
            <?php endif; ?>
          <?php endforeach; ?>

          <div class="article-back">
            <a href="blog.php" class="blog-readmore">&larr; Back to the Journal</a>
          </div>
        </div>

      </div>
    </section>

    <?php if (!empty($related)): ?>
    <section class="section section-alt">
      <div class="container">
        <div class="section-head" data-reveal>
          <span class="eyebrow">Keep Reading</span>
          <h2>More from the Journal.</h2>
        </div>

        <div class="blog-grid">
          <?php foreach ($related as $i => $rp): ?>
          <article class="blog-card" data-reveal data-reveal-delay="<?php echo 60 * $i; ?>">
            <a href="blog-post.php?slug=<?php echo urlencode($rp['slug']); ?>" class="blog-card-media">
              <img src="<?php echo htmlspecialchars($rp['image']); ?>" alt="<?php echo htmlspecialchars($rp['title']); ?>" loading="lazy">
              <span class="blog-tag"><?php echo htmlspecialchars($rp['category']); ?></span>
            </a>
            <div class="blog-card-body">
              <div class="blog-meta">
                <span><?php echo htmlspecialchars($rp['date']); ?></span>
                <span aria-hidden="true">·</span>
                <span><?php echo htmlspecialchars($rp['read']); ?></span>
              </div>
              <h3><a href="blog-post.php?slug=<?php echo urlencode($rp['slug']); ?>"><?php echo htmlspecialchars($rp['title']); ?></a></h3>
              <p><?php echo htmlspecialchars($rp['excerpt']); ?></p>
              <a href="blog-post.php?slug=<?php echo urlencode($rp['slug']); ?>" class="blog-readmore">Continue reading <span class="arrow">&rarr;</span></a>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

  </article>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
