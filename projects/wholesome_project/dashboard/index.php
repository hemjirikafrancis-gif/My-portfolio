<?php
$active='dashboard'; $adminTitle='Dashboard';
include __DIR__ . '/includes/admin-header.php';
include __DIR__ . '/../db.php';

$postCount = (int)($conn->query("SELECT COUNT(*) c FROM blogs")->fetch_assoc()['c'] ?? 0);
$catCount  = (int)($conn->query("SELECT COUNT(*) c FROM categories")->fetch_assoc()['c'] ?? 0);
$msgCount  = 0;
$r = $conn->query("SELECT COUNT(*) c FROM contact_messages");
if ($r) { $msgCount = (int)$r->fetch_assoc()['c']; }

$testiPending = 0;
$rt = $conn->query("SELECT COUNT(*) c FROM testimonials WHERE approved = 0");
if ($rt) { $testiPending = (int)$rt->fetch_assoc()['c']; }

$recent = [];
$rq = $conn->query("SELECT id, title, category, created_at FROM blogs ORDER BY id DESC LIMIT 5");
if ($rq) { while ($row = $rq->fetch_assoc()) { $recent[] = $row; } }
?>

<div class="stat-grid">
  <div class="stat-card">
    <div class="stat-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
    <div><span class="stat-label">Total Posts</span><strong><?php echo $postCount; ?></strong></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/></svg></div>
    <div><span class="stat-label">Categories</span><strong><?php echo $catCount; ?></strong></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,12 2,6"/></svg></div>
    <div><span class="stat-label">Messages</span><strong><?php echo $msgCount; ?></strong></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg></div>
    <div><span class="stat-label">Pending Testimonials</span><strong><?php echo $testiPending; ?></strong></div>
  </div>
</div>

<div class="admin-card">
  <div class="admin-card-head">
    <h3>Recent Posts</h3>
    <a href="posts/create.php" class="btn-primary btn-sm">+ New Post</a>
  </div>
  <table class="admin-table">
    <thead><tr><th>Title</th><th>Category</th><th>Date</th><th></th></tr></thead>
    <tbody>
      <?php if (empty($recent)): ?>
        <tr><td colspan="4" style="text-align:center;color:var(--text-muted);padding:24px;">No posts yet.</td></tr>
      <?php endif; ?>
      <?php foreach ($recent as $r): ?>
        <tr>
          <td><strong><?php echo htmlspecialchars($r['title']); ?></strong></td>
          <td><span class="badge"><?php echo htmlspecialchars($r['category']); ?></span></td>
          <td><?php echo htmlspecialchars(date('M j, Y', strtotime($r['created_at'] ?? 'now'))); ?></td>
          <td><a href="posts/edit.php?id=<?php echo (int)$r['id']; ?>" class="link">Edit</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/includes/admin-footer.php'; ?>
