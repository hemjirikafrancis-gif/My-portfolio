<?php
$active='posts'; $adminTitle='New Post';
require_once __DIR__ . '/../../auth.php';
include __DIR__ . '/../../db.php';

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $path = '';
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/../../uploads/';
        if (!is_dir($uploadDir)) { mkdir($uploadDir, 0775, true); }
        $name = time() . '_' . preg_replace('/[^a-zA-Z0-9_.-]/', '_', basename($_FILES['image']['name']));
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $name)) {
            $path = 'uploads/' . $name;
        }
    }
    if ($title === '' || $category === '' || $content === '') {
        $err = 'Please fill in title, category and content.';
    } else {
        $s = $conn->prepare('INSERT INTO blogs(title,category,image,content) VALUES(?,?,?,?)');
        $s->bind_param('ssss', $title, $category, $path, $content);
        if ($s->execute()) { header('Location: index.php'); exit; }
        $err = 'Failed to save post.';
    }
}

$cats = [];
$cq = $conn->query("SELECT name FROM categories ORDER BY name");
if ($cq) { while ($r = $cq->fetch_assoc()) { $cats[] = $r['name']; } }

include __DIR__ . '/../includes/admin-header.php';
?>

<div class="admin-card">
  <div class="admin-card-head"><h3>Create New Post</h3><a href="index.php" class="link">← Back</a></div>

  <?php if ($err): ?><div class="alert alert-error"><?php echo htmlspecialchars($err); ?></div><?php endif; ?>

  <form method="post" enctype="multipart/form-data" class="admin-form">
    <label>Title</label>
    <input type="text" name="title" required>

    <label>Category</label>
    <?php if (!empty($cats)): ?>
      <select name="category" required>
        <option value="">— Select category —</option>
        <?php foreach ($cats as $c): ?>
          <option value="<?php echo htmlspecialchars($c); ?>"><?php echo htmlspecialchars($c); ?></option>
        <?php endforeach; ?>
      </select>
    <?php else: ?>
      <input type="text" name="category" placeholder="e.g. Corporate Law" required>
      <small style="color:var(--text-muted)">Tip: create categories first under <a href="../categories/index.php" class="link">Categories</a>.</small>
    <?php endif; ?>

    <label>Featured Image</label>
    <input type="file" name="image" accept="image/*">

    <label>Content</label>
    <textarea name="content" rows="10" required></textarea>

    <div style="display:flex;gap:12px;margin-top:8px;">
      <button type="submit" class="btn-primary">Publish Post</button>
      <a href="index.php" class="btn-outline">Cancel</a>
    </div>
  </form>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
