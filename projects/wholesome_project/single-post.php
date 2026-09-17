<?php
include 'db.php';
$id = (int)($_GET['id'] ?? 0);
$s = $conn->prepare('SELECT * FROM blogs WHERE id=?');
$s->bind_param('i', $id);
$s->execute();
$post = $s->get_result()->fetch_assoc();
if (!$post) { header('Location: blog.php'); exit; }
$page='blog'; $pageTitle = $post['title'] . ' – Wholesome Legal House';
include 'includes/header.php';
$ph_title = htmlspecialchars($post['title']); $ph_sub = htmlspecialchars($post['category'] ?: 'Article'); $ph_crumb='Blog'; $ph_image='Images/Img-2.jpg';
include 'includes/page-hero.php';

/* ── Render plain text with basic formatting ── */
function renderContent(string $raw): string {
    $lines = explode("\n", $raw);
    $out   = '';
    $inList = false;

    foreach ($lines as $line) {
        $t = trim($line);

        // blank line — close list if open, then paragraph break
        if ($t === '') {
            if ($inList) { $out .= "</ul>\n"; $inList = false; }
            continue;
        }

        // Detect ALL-CAPS headings (e.g. "OPINION", "SUMMARY", "IMPACT ON ...")
        if (ctype_upper(preg_replace('/[^A-Z\s\/\(\)]/', '', $t)) && strlen($t) < 120 && strlen($t) > 4 && !preg_match('/^\d/', $t)) {
            if ($inList) { $out .= "</ul>\n"; $inList = false; }
            $out .= '<h3 class="post-subheading">' . htmlspecialchars($t) . "</h3>\n";
            continue;
        }

        // Numbered list items: "1. …" or "1) …"
        if (preg_match('/^\d+[\.\)]\s+/', $t)) {
            if ($inList) { $out .= "</ul>\n"; $inList = false; }
            // Keep as paragraph (structured bullet below handles bullet lists)
            $out .= '<p class="post-para">' . nl2br(htmlspecialchars($t)) . "</p>\n";
            continue;
        }

        // Bullet list items: "- …" or "• …"
        if (preg_match('/^[-•]\s+/', $t)) {
            if (!$inList) { $out .= "<ul class=\"post-list\">\n"; $inList = true; }
            $item = preg_replace('/^[-•]\s+/', '', $t);
            $out .= '<li>' . htmlspecialchars($item) . "</li>\n";
            continue;
        }

        // Case citations — lines starting with author vs. XXXX (2021)
        if (preg_match('/\(\d{4}\)\s+LPELR/i', $t) || preg_match('/^[A-Z\s&]+v\.\s+[A-Z]/', $t)) {
            if ($inList) { $out .= "</ul>\n"; $inList = false; }
            $out .= '<p class="post-citation">' . htmlspecialchars($t) . "</p>\n";
            continue;
        }

        // Regular paragraph
        if ($inList) { $out .= "</ul>\n"; $inList = false; }
        $out .= '<p class="post-para">' . htmlspecialchars($t) . "</p>\n";
    }

    if ($inList) $out .= "</ul>\n";
    return $out;
}

// Related posts
$rel = [];
if (!empty($post['category'])) {
    $cat = $post['category'];
    $rid = (int)$post['id'];
    $rs = $conn->prepare("SELECT id, title, image, created_at FROM blogs WHERE category=? AND id!=? ORDER BY id DESC LIMIT 2");
    $rs->bind_param('si', $cat, $rid);
    $rs->execute();
    $rr = $rs->get_result();
    while ($r = $rr->fetch_assoc()) { $rel[] = $r; }
}
?>

<section class="single-post-section">
  <div class="container" style="max-width:900px;">

    <?php if (!empty($post['image'])): ?>
      <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>"
           style="width:100%;max-height:420px;object-fit:cover;border-radius:var(--radius-lg);margin-bottom:32px;" />
    <?php endif; ?>

    <div class="post-header-meta">
      <span class="blog-cat" style="position:static;display:inline-block;"><?php echo htmlspecialchars($post['category'] ?: 'Uncategorized'); ?></span>
      <span class="blog-date" style="margin-left:12px;"><?php echo date('F j, Y', strtotime($post['created_at'] ?? 'now')); ?></span>
    </div>

    <div class="post-content">
      <?php echo renderContent($post['content']); ?>
    </div>

    <div style="margin-top:48px;padding-top:24px;border-top:1px solid var(--border);">
      <a href="blog.php" class="btn-outline">← Back to Blog</a>
    </div>

    <?php if (!empty($rel)): ?>
    <div class="related-posts" style="margin-top:56px;">
      <h4 style="margin-bottom:24px;font-size:1.15rem;color:var(--primary);">Related Articles</h4>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:24px;">
        <?php foreach ($rel as $rp): ?>
          <a href="single-post.php?id=<?php echo (int)$rp['id']; ?>" class="blog-card" style="text-decoration:none;display:block;">
            <div class="blog-img">
              <img src="<?php echo htmlspecialchars($rp['image'] ?: 'Images/Blog-1.png'); ?>" alt="" />
            </div>
            <div class="blog-body">
              <span class="blog-date"><?php echo date('M j, Y', strtotime($rp['created_at'] ?? 'now')); ?></span>
              <h4 style="font-size:.95rem;"><?php echo htmlspecialchars(mb_strimwidth($rp['title'], 0, 90, '…')); ?></h4>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

  </div>
</section>

<?php include 'includes/footer.php'; ?>
