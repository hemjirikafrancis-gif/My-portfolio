<?php
$active='categories'; $adminTitle='Edit Category';
require_once __DIR__ . '/../../auth.php';
include __DIR__ . '/../../db.php';

$id = (int)($_GET['id'] ?? 0);
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $path = $_POST['existing_image'] ?? '';
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/../../uploads/';
        if (!is_dir($uploadDir)) { mkdir($uploadDir, 0775, true); }
        $fname = time() . '_' . preg_replace('/[^a-zA-Z0-9_.-]/', '_', basename($_FILES['image']['name']));
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fname)) {
            $path = 'uploads/' . $fname;
        }
    }
    if ($name === '') { $err = 'Name is required.'; }
    else {
        $u = $conn->prepare('UPDATE categories SET name=?, image=? WHERE id=?');
        $u->bind_param('ssi', $name, $path, $id);
        if ($u->execute()) { header('Location: index.php'); exit; }
        $err = 'Failed to update category.';
    }
}

$s = $conn->prepare('SELECT * FROM categories WHERE id=?');
$s->bind_param('i', $id);
$s->execute();
$cat = $s->get_result()->fetch_assoc();
if (!$cat) { die('Category not found'); }

include __DIR__ . '/../includes/admin-header.php';
?>

<div class="admin-card">
  <div class="admin-card-head"><h3>Edit Category</h3><a href="index.php" class="link">← Back</a></div>
  <?php if ($err): ?><div class="alert alert-error"><?php echo htmlspecialchars($err); ?></div><?php endif; ?>

  <form method="post" enctype="multipart/form-data" class="admin-form">
    <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($cat['image']); ?>">
    <label>Name</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($cat['name']); ?>" required>
    <label>Image</label>
    <?php if (!empty($cat['image'])): ?>
      <img src="<?php echo htmlspecialchars('../../' . $cat['image']); ?>" alt="" style="max-width:160px;border-radius:6px;margin-bottom:8px;">
    <?php endif; ?>
    <input type="file" name="image" accept="image/*">
    <div style="display:flex;gap:12px;margin-top:8px;">
      <button type="submit" class="btn-primary">Update Category</button>
      <a href="index.php" class="btn-outline">Cancel</a>
    </div>
  </form>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
