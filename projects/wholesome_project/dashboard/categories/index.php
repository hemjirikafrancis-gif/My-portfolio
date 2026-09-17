<?php
$active='categories'; $adminTitle='Categories';
include __DIR__ . '/../includes/admin-header.php';
include __DIR__ . '/../../db.php';

$flash = isset($_GET['deleted']) ? 'Category deleted.' : '';

// Per-page selector (saved in session)
$allowed_per_page = [5, 10, 20, 50];
if (isset($_GET['per_page']) && in_array((int)$_GET['per_page'], $allowed_per_page)) {
  $_SESSION['cats_per_page'] = (int)$_GET['per_page'];
}
$per_page = $_SESSION['cats_per_page'] ?? 10;

// Pagination
$cur_page = max(1, (int)($_GET['pg'] ?? 1));

$total_q = $conn->query("SELECT COUNT(*) as cnt FROM categories");
$total_rows = $total_q ? (int)$total_q->fetch_assoc()['cnt'] : 0;
$total_pages = max(1, (int)ceil($total_rows / $per_page));
$cur_page = min($cur_page, $total_pages);
$offset = ($cur_page - 1) * $per_page;

$rows = [];
$q = $conn->query("SELECT * FROM categories ORDER BY name LIMIT $per_page OFFSET $offset");
if ($q) { while ($r = $q->fetch_assoc()) { $rows[] = $r; } }

function catPagUrl($pg, $per_page) {
  return 'index.php?pg=' . $pg . '&per_page=' . $per_page;
}
?>

<?php if ($flash): ?><div class="alert alert-success"><?php echo htmlspecialchars($flash); ?></div><?php endif; ?>

<div class="admin-card">
    <div class="admin-card-head">
        <h3>All Categories <span class="record-count"><?php echo $total_rows; ?> total</span></h3>
        <div class="head-actions">
            <div class="per-page-select">
                <label for="per_page_select">Show:</label>
                <select id="per_page_select" onchange="window.location='index.php?pg=1&per_page='+this.value">
                    <?php foreach ([5, 10, 20, 50] as $opt): ?>
                    <option value="<?php echo $opt; ?>" <?php echo ($opt === $per_page ? ' selected' : ''); ?>>
                        <?php echo $opt; ?> per page</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <a href="create.php" class="btn-primary btn-sm">+ New Category</a>
        </div>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width:60px;">Image</th>
                <th>Name</th>
                <th>Created</th>
                <th style="width:160px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($rows)): ?>
            <tr>
                <td colspan="4" style="text-align:center;color:var(--text-muted);padding:32px;">No categories yet. <a
                        href="create.php" class="link">Add one</a>.</td>
            </tr>
            <?php endif; ?>
            <?php foreach ($rows as $r): ?>
            <tr>
                <td><img src="<?php echo htmlspecialchars($r['image'] ? '../../' . $r['image'] : '../../Images/Blog-1.png'); ?>"
                        class="thumb" alt=""></td>
                <td><strong><?php echo htmlspecialchars($r['name']); ?></strong></td>
                <td><?php echo htmlspecialchars(date('M j, Y', strtotime($r['created_at'] ?? 'now'))); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo (int)$r['id']; ?>" class="btn-mini">Edit</a>
                    <a href="delete.php?id=<?php echo (int)$r['id']; ?>" class="btn-mini btn-danger"
                        onclick="return confirm('Delete this category?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($total_pages > 1): ?>
    <div class="admin-pagination">
        <?php if ($cur_page > 1): ?>
        <a href="<?php echo catPagUrl($cur_page - 1, $per_page); ?>" class="pag-btn">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6" />
            </svg>
        </a>
        <?php else: ?>
        <span class="pag-btn pag-disabled"><svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6" />
            </svg></span>
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
        <a href="<?php echo catPagUrl($pg, $per_page); ?>" class="pag-btn"><?php echo $pg; ?></a>
        <?php endif;
      $prev = $pg;
    endforeach; ?>

        <?php if ($cur_page < $total_pages): ?>
        <a href="<?php echo catPagUrl($cur_page + 1, $per_page); ?>" class="pag-btn">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="9 18 15 12 9 6" />
            </svg>
        </a>
        <?php else: ?>
        <span class="pag-btn pag-disabled"><svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <polyline points="9 18 15 12 9 6" />
            </svg></span>
        <?php endif; ?>

        <span class="pag-info">Page <?php echo $cur_page; ?> of <?php echo $total_pages; ?></span>
    </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>