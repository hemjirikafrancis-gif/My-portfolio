<?php
require __DIR__ . '/auth.php';
require_admin();

$posts = $pdo->query("SELECT p.*, c.name AS category FROM posts p
                      LEFT JOIN categories c ON c.id = p.category_id
                      ORDER BY p.created_at DESC")->fetchAll();
$catCount = (int)$pdo->query('SELECT COUNT(*) FROM categories')->fetchColumn();
$flash = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard – Borderless Analysts Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../style.css"><link rel="stylesheet" href="../blog.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="admin-body">
  <div class="admin-top">
    <div class="brand">Borderless <span>Admin</span></div>
    <div>
      <span style="font-size:.85rem;opacity:.8;">Hi, <?= e($_SESSION['admin_name']) ?></span>
      <a href="../blog.php" target="_blank">View blog</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <div class="admin-wrap">
    <?php if ($flash): ?><div class="alert alert-ok"><?= e($flash) ?></div><?php endif; ?>

    <div class="stat-grid">
      <div class="stat"><b><?= count($posts) ?></b><span>Total posts</span></div>
      <div class="stat"><b><?= $catCount ?></b><span>Categories</span></div>
      <div class="stat"><b><?= count(array_filter($posts, fn($p) => $p['featured'])) ?></b><span>Featured</span></div>
    </div>

    <div class="panel">
      <div class="panel-head">
        <h3>All blog posts</h3>
        <a class="btn btn-primary" href="post-form.php"><i class="fa-solid fa-plus"></i> Create new post</a>
      </div>

      <?php if (!$posts): ?>
        <p style="color:#7a8794;">No posts yet — create your first article.</p>
      <?php else: ?>
      <div style="overflow-x:auto;">
      <table class="admin-table">
        <thead><tr><th>Title</th><th>Category</th><th>Author</th><th>Date</th><th style="text-align:right">Actions</th></tr></thead>
        <tbody>
        <?php foreach ($posts as $p): ?>
          <tr>
            <td>
              <a href="../post.php?slug=<?= e($p['slug']) ?>" target="_blank" style="font-weight:600;color:var(--primary)"><?= e($p['title']) ?></a>
              <?php if ($p['featured']): ?> <span class="badge">Featured</span><?php endif; ?>
            </td>
            <td><span class="badge"><?= e($p['category'] ?? '—') ?></span></td>
            <td><?= e($p['author']) ?></td>
            <td><?= date('j M Y', strtotime($p['created_at'])) ?></td>
            <td style="text-align:right;white-space:nowrap;">
              <a class="btn-sm btn-edit" href="post-form.php?id=<?= (int)$p['id'] ?>">Edit</a>
              <form method="post" action="delete.php" style="display:inline" onsubmit="return confirm('Delete this post permanently?')">
                <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                <button class="btn-sm btn-del" type="submit">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      </div>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
