<?php
$active='posts'; $adminTitle='Posts';
include __DIR__ . '/../includes/admin-header.php';
include __DIR__ . '/../../db.php';

$flash = '';
if (isset($_GET['deleted'])) { $flash = 'Post deleted.'; }

// Pagination
$per_page = 10;
$cur_page = max(1, (int)($_GET['pg'] ?? 1));

$total_q = $conn->query("SELECT COUNT(*) as cnt FROM blogs");
$total_rows = $total_q ? (int)$total_q->fetch_assoc()['cnt'] : 0;
$total_pages = max(1, (int)ceil($total_rows / $per_page));
$cur_page = min($cur_page, $total_pages);
$offset = ($cur_page - 1) * $per_page;

$rows = [];
$q = $conn->query("SELECT * FROM blogs ORDER BY id DESC LIMIT $per_page OFFSET $offset");
if ($q) { while ($r = $q->fetch_assoc()) { $rows[] = $r; } }

function postPagUrl($pg) {
  return 'index.php?pg=' . $pg;
}
?>

<?php if ($flash): ?><div class="alert alert-success"><?php echo htmlspecialchars($flash); ?></div><?php endif; ?>

<div class="admin-card">
  <div class="admin-card-head">
    <h3>All Posts <span class="record-count"><?php echo $total_rows; ?> total</span></h3>
    <a href="create.php" class="btn-primary btn-sm">+ New Post</a>
  </div>
  <table class="admin-table">
    <thead><tr><th style="width:60px;">Image</th><th>Title</th><th>Category</th><th>Date</th><th style="width:160px;">Actions</th></tr></thead>
    <tbody>
      <?php if (empty($rows)): ?>
        <tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:32px;">No posts yet. <a href="create.php" class="link">Create your first post</a>.</td></tr>
      <?php endif; ?>
      <?php foreach ($rows as $r): ?>
        <tr>
          <td><img src="<?php echo htmlspecialchars($r['image'] ? '../../' . $r['image'] : '../../Images/Blog-1.png'); ?>" class="thumb" alt=""></td>
          <td><strong><?php echo htmlspecialchars($r['title']); ?></strong></td>
          <td><span class="badge"><?php echo htmlspecialchars($r['category']); ?></span></td>
          <td><?php echo htmlspecialchars(date('M j, Y', strtotime($r['created_at'] ?? 'now'))); ?></td>
          <td>
            <a href="edit.php?id=<?php echo (int)$r['id']; ?>" class="btn-mini">Edit</a>
            <a href="delete.php?id=<?php echo (int)$r['id']; ?>" class="btn-mini btn-danger" onclick="return confirm('Delete this post?');">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <?php if ($total_pages > 1): ?>
  <div class="admin-pagination">
    <?php if ($cur_page > 1): ?>
      <a href="<?php echo postPagUrl($cur_page - 1); ?>" class="pag-btn">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
      </a>
    <?php else: ?>
      <span class="pag-btn pag-disabled"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg></span>
    <?php endif; ?>

    <?php
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
        <span class="pag-btn pag-active"><?php echo $pg; ?></span>
      <?php else: ?>
        <a href="<?php echo postPagUrl($pg); ?>" class="pag-btn"><?php echo $pg; ?></a>
      <?php endif;
      $prev = $pg;
    endforeach; ?>

    <?php if ($cur_page < $total_pages): ?>
      <a href="<?php echo postPagUrl($cur_page + 1); ?>" class="pag-btn">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
      </a>
    <?php else: ?>
      <span class="pag-btn pag-disabled"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></span>
    <?php endif; ?>

    <span class="pag-info">Page <?php echo $cur_page; ?> of <?php echo $total_pages; ?></span>
  </div>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
