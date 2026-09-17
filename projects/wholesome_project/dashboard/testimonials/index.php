<?php
$active='testimonials'; $adminTitle='Testimonials';
require_once __DIR__ . '/../../auth.php';
include __DIR__ . '/../includes/admin-header.php';
include __DIR__ . '/../../db.php';

$conn->query("CREATE TABLE IF NOT EXISTS testimonials (
  id INT AUTO_INCREMENT PRIMARY KEY,
  author_name VARCHAR(150) NOT NULL,
  author_role VARCHAR(150) DEFAULT 'Client',
  email VARCHAR(180) DEFAULT NULL,
  image VARCHAR(255) DEFAULT NULL,
  message TEXT NOT NULL,
  approved TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$flash = '';
if (isset($_GET['approved'])) $flash = 'Testimonial approved.';
if (isset($_GET['rejected'])) $flash = 'Testimonial unapproved.';
if (isset($_GET['deleted']))  $flash = 'Testimonial deleted.';

$rows = [];
$q = $conn->query("SELECT * FROM testimonials ORDER BY approved ASC, id DESC");
if ($q) { while ($r = $q->fetch_assoc()) { $rows[] = $r; } }
?>

<?php if ($flash): ?><div class="alert alert-success"><?php echo htmlspecialchars($flash); ?></div><?php endif; ?>

<div class="admin-card">
  <div class="admin-card-head">
    <h3>All Testimonials <span class="record-count"><?php echo count($rows); ?> total</span></h3>
    <a href="create.php" class="btn-primary">+ New Testimonial</a>
  </div>
  <table class="admin-table">
    <thead><tr><th style="width:60px;">Photo</th><th>Author</th><th>Message</th><th>Status</th><th>Date</th><th style="width:220px;">Actions</th></tr></thead>
    <tbody>
      <?php if (empty($rows)): ?>
        <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:32px;">No testimonials yet.</td></tr>
      <?php endif; ?>
      <?php foreach ($rows as $r): ?>
        <tr>
          <td>
            <?php $img = $r['image'] ? '../../' . htmlspecialchars($r['image']) : '../../Images/Testimonial-1.png'; ?>
            <img src="<?php echo $img; ?>" class="thumb" alt="" onerror="this.src='../../Images/Testimonial-1.png'">
          </td>
          <td>
            <strong><?php echo htmlspecialchars($r['author_name']); ?></strong><br>
            <small style="color:var(--text-muted)"><?php echo htmlspecialchars($r['author_role']); ?></small>
            <?php if (!empty($r['email'])): ?><br><small><?php echo htmlspecialchars($r['email']); ?></small><?php endif; ?>
          </td>
          <td style="max-width:380px;"><?php echo nl2br(htmlspecialchars(mb_strimwidth($r['message'], 0, 220, '…'))); ?></td>
          <td>
            <?php if ((int)$r['approved'] === 1): ?>
              <span class="badge" style="background:#1f7a3a;color:#fff;">Approved</span>
            <?php else: ?>
              <span class="badge" style="background:#a3661f;color:#fff;">Pending</span>
            <?php endif; ?>
          </td>
          <td><?php echo htmlspecialchars(date('M j, Y', strtotime($r['created_at'] ?? 'now'))); ?></td>
          <td>
            <?php if ((int)$r['approved'] === 1): ?>
              <a href="toggle.php?id=<?php echo (int)$r['id']; ?>&to=0" class="btn-mini">Unapprove</a>
            <?php else: ?>
              <a href="toggle.php?id=<?php echo (int)$r['id']; ?>&to=1" class="btn-mini">Approve</a>
            <?php endif; ?>
            <a href="edit.php?id=<?php echo (int)$r['id']; ?>" class="btn-mini">Edit</a>
            <a href="delete.php?id=<?php echo (int)$r['id']; ?>" class="btn-mini btn-danger" onclick="return confirm('Delete this testimonial?');">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
