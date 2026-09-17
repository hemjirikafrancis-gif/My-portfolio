<?php
$active='posts'; $adminTitle='Edit Post';
require_once __DIR__ . '/../../auth.php';
include __DIR__ . '/../../db.php';

$id = (int)($_GET['id'] ?? 0);
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $path = $_POST['existing_image'] ?? '';
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
        $u = $conn->prepare('UPDATE blogs SET title=?, category=?, image=?, content=? WHERE id=?');
        $u->bind_param('ssssi', $title, $category, $path, $content, $id);
        if ($u->execute()) { header('Location: index.php'); exit; }
        $err = 'Failed to update post.';
    }
}

$s = $conn->prepare('SELECT * FROM blogs WHERE id=?');
$s->bind_param('i', $id);
$s->execute();
$post = $s->get_result()->fetch_assoc();
if (!$post) { die('Post not found'); }

$cats = [];
$cq = $conn->query("SELECT name FROM categories ORDER BY name");
if ($cq) { while ($r = $cq->fetch_assoc()) { $cats[] = $r['name']; } }

include __DIR__ . '/../includes/admin-header.php';
?>

<div class="admin-card">
  <div class="admin-card-head"><h3>Edit Post</h3><a href="index.php" class="link">← Back</a></div>

  <?php if ($err): ?><div class="alert alert-error"><?php echo htmlspecialchars($err); ?></div><?php endif; ?>

  <form method="post" enctype="multipart/form-data" class="admin-form">
    <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($post['image']); ?>">

    <label>Title</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>

    <label>Category</label>
    <select name="category" required>
      <option value="">— Select category —</option>
      <?php foreach ($cats as $c): ?>
        <option value="<?php echo htmlspecialchars($c); ?>" <?php echo $c===$post['category']?'selected':''; ?>><?php echo htmlspecialchars($c); ?></option>
      <?php endforeach; ?>
      <?php if (!in_array($post['category'], $cats, true)): ?>
        <option value="<?php echo htmlspecialchars($post['category']); ?>" selected><?php echo htmlspecialchars($post['category']); ?></option>
      <?php endif; ?>
    </select>

    <label>Featured Image</label>
    <?php if (!empty($post['image'])): ?>
      <img src="<?php echo htmlspecialchars('../../' . $post['image']); ?>" alt="" style="max-width:200px;border-radius:6px;margin-bottom:8px;">
    <?php endif; ?>
    <input type="file" name="image" accept="image/*">

    <label>Content</label>
    <textarea name="content" rows="10" required><?php echo htmlspecialchars($post['content']); ?></textarea>

    <div style="display:flex;gap:12px;margin-top:8px;">
      <button type="submit" class="btn-primary">Update Post</button>
      <a href="index.php" class="btn-outline">Cancel</a>
    </div>
  </form>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
