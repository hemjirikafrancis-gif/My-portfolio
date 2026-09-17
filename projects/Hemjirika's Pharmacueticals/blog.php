<?php
$pageTitle       = "Journal";
$pageDescription = "The Hemjirika's Pharmaceuticals Journal — essays on medicine, manufacturing quality, regulatory science and public health in Nigeria.";
$canonicalPath   = "/blog.php";
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/blog-data.php';

$posts    = $blogPosts;
$featured = array_shift($posts);
?>

<main>

  <section class="blog-hero" id="blog-hero">
    <div class="container blog-hero-inner">
      <span class="eyebrow" data-reveal>The Journal</span>
      <h1 data-reveal data-reveal-delay="60">
        Notes from the bench, the line<br>and the pharmacy floor.
      </h1>
      <p class="lede" data-reveal data-reveal-delay="120">
        Essays and field notes on quality-assured medicines, regulatory science,
        and the practice of pharmacy in Nigeria — written by the people who do the work.
      </p>
    </div>
  </section>

  <section class="section blog-featured">
    <div class="container">
      <article class="blog-feature-card" data-reveal>
        <a href="blog-post.php?slug=<?php echo urlencode($featured['slug']); ?>" class="blog-feature-media">
          <img src="<?php echo $featured['image']; ?>" alt="<?php echo htmlspecialchars($featured['title']); ?>" loading="lazy">
          <span class="blog-tag"><?php echo $featured['category']; ?></span>
        </a>
        <div class="blog-feature-copy">
          <span class="eyebrow">Featured Essay</span>
          <h2><a href="blog-post.php?slug=<?php echo urlencode($featured['slug']); ?>"><?php echo htmlspecialchars($featured['title']); ?></a></h2>
          <p class="lede"><?php echo htmlspecialchars($featured['excerpt']); ?></p>
          <div class="blog-meta">
            <span><?php echo $featured['date']; ?></span>
            <span aria-hidden="true">·</span>
            <span><?php echo $featured['read']; ?></span>
          </div>
          <a href="blog-post.php?slug=<?php echo urlencode($featured['slug']); ?>" class="btn btn-primary">Read the essay <span class="arrow">&rarr;</span></a>
        </div>
      </article>
    </div>
  </section>

  <section class="section section-alt">
    <div class="container">
      <div class="section-head" data-reveal>
        <span class="eyebrow">Latest Entries</span>
        <h2>More from the Journal.</h2>
      </div>

      <div class="blog-grid">
        <?php foreach ($posts as $i => $post): ?>
        <article class="blog-card" data-reveal data-reveal-delay="<?php echo 60 * $i; ?>">
          <a href="blog-post.php?slug=<?php echo urlencode($post['slug']); ?>" class="blog-card-media">
            <img src="<?php echo $post['image']; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" loading="lazy">
            <span class="blog-tag"><?php echo $post['category']; ?></span>
          </a>
          <div class="blog-card-body">
            <div class="blog-meta">
              <span><?php echo $post['date']; ?></span>
              <span aria-hidden="true">·</span>
              <span><?php echo $post['read']; ?></span>
            </div>
            <h3><a href="blog-post.php?slug=<?php echo urlencode($post['slug']); ?>"><?php echo htmlspecialchars($post['title']); ?></a></h3>
            <p><?php echo htmlspecialchars($post['excerpt']); ?></p>
            <a href="blog-post.php?slug=<?php echo urlencode($post['slug']); ?>" class="blog-readmore">Continue reading <span class="arrow">&rarr;</span></a>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
