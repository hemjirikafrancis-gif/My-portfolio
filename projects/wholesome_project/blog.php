<?php
$page='blog'; $pageTitle='Blog – Wholesome Legal House';

// All static posts (hardcoded from wholesomelegal.com)
$all_static = [
  [
    'id'       => 'post1',
    'title'    => 'Implications of proposed criminalization of casualization and outlawing of outsourcing and its impact on Directors/Management teams.',
    'category' => 'Criminal Case',
    'image'    => 'Images/Blog-1.png',
    'date'     => 'May 24, 2021',
    'excerpt'  => 'The National Assembly of The Federal Republic of Nigeria is considering a bill to amend the Labour Act to prohibit and criminalise casualization of workers after six months of engagement by employers in Nigeria, and outsourcing employment in core areas of operation.',
    'file'     => 'post-casualization.php',
  ],
  [
    'id'       => 'post2',
    'title'    => 'WHETHER EMPLOYMENT OF FEMALE JUNIOR STAFFS TO WORK INCLUSIVE NIGHT SHIFTS CAN BE SAID TO BE LEGAL UNDER THE LABOUR ACT',
    'category' => 'Uncategorized',
    'image'    => 'Images/Blog-2.jpg',
    'date'     => 'May 24, 2021',
    'excerpt'  => 'Female employees are considered sui generis employees thereby classifying them as vulnerable due to their peculiar nature. Section 55(1) of the Labour Act provides that women cannot engage in manual labour overnight — but there are conditions under which night shifts may be permitted.',
    'file'     => 'post-nightshift.php',
  ],
  [
    'id'       => 'post3',
    'title'    => 'Whether an employee who, in substance, is a manager but goes by the title "Director" can automatically exercise all the powers and enjoy the benefits of a director within the meaning of CAMA',
    'category' => 'Corporate Case',
    'image'    => 'Images/Blog-3.png',
    'date'     => 'May 24, 2021',
    'excerpt'  => 'Section 269(1) of CAMA 2020 defines a director as a person duly appointed by the company to direct and manage its business. The question is whether a manager who holds the title "Director" but was never formally appointed can exercise the powers and enjoy the benefits of a director.',
    'file'     => 'post-director-cama.php',
  ],
];

// Get search term & pagination params
$search   = trim($_GET['search'] ?? '');
$cur_page = max(1, (int)($_GET['pg'] ?? 1));
$per_page = 6; // posts per page

// Filter static posts by search term
if ($search !== '') {
  $term = mb_strtolower($search);
  $filtered_static = array_values(array_filter($all_static, function($p) use ($term) {
    return str_contains(mb_strtolower($p['title']), $term)
        || str_contains(mb_strtolower($p['excerpt']), $term)
        || str_contains(mb_strtolower($p['category']), $term);
  }));
} else {
  $filtered_static = $all_static;
}

// Pull DB posts if DB is available
$db_posts = [];
@include_once 'db.php';
if (isset($conn)) {
  if ($search !== '') {
    $like = '%' . $search . '%';
    $stmt = $conn->prepare('SELECT * FROM blogs WHERE title LIKE ? OR content LIKE ? OR category LIKE ? ORDER BY id DESC');
    $stmt->bind_param('sss', $like, $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
  } else {
    $result = $conn->query('SELECT * FROM blogs ORDER BY id DESC');
  }
  if ($result) { while ($row = $result->fetch_assoc()) { $db_posts[] = $row; } }

  // Categories: count from DB + count from static posts
  $db_cats = [];
  $cq = $conn->query("SELECT c.name, COUNT(b.id) as cnt FROM categories c LEFT JOIN blogs b ON b.category=c.name GROUP BY c.name ORDER BY c.name");
  if ($cq) { while ($r = $cq->fetch_assoc()) { $db_cats[$r['name']] = (int)$r['cnt']; } }

  $static_cat_counts = array_count_values(array_column($all_static, 'category'));
  foreach ($static_cat_counts as $cat => $cnt) {
    $db_cats[$cat] = ($db_cats[$cat] ?? 0) + $cnt;
  }
  ksort($db_cats);
  $cats = [];
  foreach ($db_cats as $name => $cnt) { $cats[] = ['name' => $name, 'cnt' => $cnt]; }

} else {
  $static_cat_counts = array_count_values(array_column($all_static, 'category'));
  ksort($static_cat_counts);
  $cats = [];
  foreach ($static_cat_counts as $name => $cnt) { $cats[] = ['name' => $name, 'cnt' => $cnt]; }
}

// Merge ALL posts then paginate
$all_posts = [];
foreach ($filtered_static as $p) {
  $all_posts[] = ['type' => 'static', 'data' => $p];
}
foreach ($db_posts as $p) {
  $all_posts[] = ['type' => 'db', 'data' => $p];
}

$total_posts  = count($all_posts);
$total_pages  = max(1, (int)ceil($total_posts / $per_page));
$cur_page     = min($cur_page, $total_pages);
$offset       = ($cur_page - 1) * $per_page;
$paged_posts  = array_slice($all_posts, $offset, $per_page);

// Build pagination URL helper
function pagUrl($pg, $search) {
  $params = ['pg' => $pg];
  if ($search !== '') $params['search'] = $search;
  return 'blog.php?' . http_build_query($params);
}

include 'includes/header.php';
$ph_title='Our <em>Blog</em>'; $ph_sub='Latest Legal Insights'; $ph_crumb='Blog'; $ph_image='Images/Img-1.jpg';
include 'includes/page-hero.php';
?>

<!-- Mobile-only: Search bar appears ABOVE posts -->
<div class="blog-mobile-search">
  <div class="container">
    <form method="GET" class="search-bar">
      <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search articles..." />
      <button aria-label="Search"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></button>
    </form>
  </div>
</div>

<section class="blog-section">
  <div class="container">
    <div class="blog-layout">
      <div class="blog-posts">

        <?php if ($total_posts === 0): ?>
          <div class="no-results">
            <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <h4>No posts found</h4>
            <p>No articles matched "<strong><?php echo htmlspecialchars($search); ?></strong>". Try a different keyword.</p>
            <a href="blog.php" class="btn-outline" style="margin-top:12px;">Clear Search</a>
          </div>
        <?php endif; ?>

        <?php foreach ($paged_posts as $entry):
          $p = $entry['data'];
          if ($entry['type'] === 'static'): ?>
        <article class="blog-card">
          <div class="blog-img">
            <img src="<?php echo $p['image']; ?>" alt="<?php echo htmlspecialchars($p['title']); ?>" />
            <span class="blog-cat"><?php echo htmlspecialchars($p['category']); ?></span>
          </div>
          <div class="blog-body">
            <span class="blog-date"><?php echo $p['date']; ?></span>
            <h4><?php echo htmlspecialchars($p['title']); ?></h4>
            <p><?php echo htmlspecialchars($p['excerpt']); ?></p>
            <a href="<?php echo $p['file']; ?>" class="read-more">Read More →</a>
          </div>
        </article>
          <?php else: ?>
        <article class="blog-card">
          <div class="blog-img">
            <img src="<?php echo htmlspecialchars($p['image'] ?: 'Images/Blog-1.png'); ?>" alt="<?php echo htmlspecialchars($p['title']); ?>" />
            <span class="blog-cat"><?php echo htmlspecialchars($p['category'] ?: 'Uncategorized'); ?></span>
          </div>
          <div class="blog-body">
            <span class="blog-date"><?php echo date('M j, Y', strtotime($p['created_at'] ?? 'now')); ?></span>
            <h4><?php echo htmlspecialchars($p['title']); ?></h4>
            <p><?php echo htmlspecialchars(mb_strimwidth(strip_tags($p['content']), 0, 160, '…')); ?></p>
            <a href="single-post.php?id=<?php echo (int)$p['id']; ?>" class="read-more">Read More →</a>
          </div>
        </article>
          <?php endif; ?>
        <?php endforeach; ?>

        <?php if ($total_pages > 1): ?>
        <nav class="blog-pagination" aria-label="Blog pages">
          <?php if ($cur_page > 1): ?>
            <a href="<?php echo pagUrl($cur_page - 1, $search); ?>" class="pag-btn pag-prev" aria-label="Previous page">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            </a>
          <?php else: ?>
            <span class="pag-btn pag-prev pag-disabled" aria-disabled="true">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            </span>
          <?php endif; ?>

          <?php
          // Show smart page range: always show first, last, current ±1, with ellipsis
          $pages_to_show = [];
          for ($i = 1; $i <= $total_pages; $i++) {
            if ($i === 1 || $i === $total_pages || abs($i - $cur_page) <= 1) {
              $pages_to_show[] = $i;
            }
          }
          $prev = null;
          foreach ($pages_to_show as $pg):
            if ($prev !== null && $pg - $prev > 1): ?>
              <span class="pag-ellipsis">…</span>
            <?php endif;
            if ($pg === $cur_page): ?>
              <span class="pag-btn pag-active" aria-current="page"><?php echo $pg; ?></span>
            <?php else: ?>
              <a href="<?php echo pagUrl($pg, $search); ?>" class="pag-btn"><?php echo $pg; ?></a>
            <?php endif;
            $prev = $pg;
          endforeach; ?>

          <?php if ($cur_page < $total_pages): ?>
            <a href="<?php echo pagUrl($cur_page + 1, $search); ?>" class="pag-btn pag-next" aria-label="Next page">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
          <?php else: ?>
            <span class="pag-btn pag-next pag-disabled" aria-disabled="true">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            </span>
          <?php endif; ?>

          <span class="pag-info">Page <?php echo $cur_page; ?> of <?php echo $total_pages; ?></span>
        </nav>
        <?php endif; ?>

      </div>

      <aside class="blog-sidebar">
        <div class="sidebar-widget blog-desktop-search">
          <h5>Search</h5>
          <form method="GET" class="search-bar">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search articles..." />
            <button aria-label="Search"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></button>
          </form>
        </div>
        <div class="sidebar-widget">
          <h5>Categories</h5>
          <ul class="cat-list">
            <?php foreach ($cats as $c): ?>
              <li><a href="?search=<?php echo urlencode($c['name']); ?>"><?php echo htmlspecialchars($c['name']); ?> <span><?php echo (int)$c['cnt']; ?></span></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="sidebar-widget">
          <h5>Recent Posts</h5>
          <ul class="recent-posts">
            <?php foreach ($all_static as $r): ?>
            <li>
              <img src="<?php echo $r['image']; ?>" alt="" />
              <div>
                <a href="<?php echo $r['file']; ?>"><?php echo htmlspecialchars(mb_strimwidth($r['title'], 0, 55, '…')); ?></a>
                <span><?php echo $r['date']; ?></span>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="sidebar-widget sidebar-cta">
          <h5>Free Consultation</h5>
          <p>Need legal advice? Our team is ready to help you today.</p>
          <a href="contact.php" class="btn-primary" style="width:100%;text-align:center;display:block;">Get in Touch</a>
        </div>
      </aside>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
