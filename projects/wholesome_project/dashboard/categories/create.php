<?php
$active='categories'; $adminTitle='New Category';
require_once __DIR__ . '/../../auth.php';
include __DIR__ . '/../../db.php';

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $path = '';
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
        $s = $conn->prepare('INSERT INTO categories(name, image) VALUES(?, ?)');
        $s->bind_param('ss', $name, $path);
        if ($s->execute()) { header('Location: index.php'); exit; }
        $err = 'Failed to save category (it may already exist).';
    }
}

include __DIR__ . '/../includes/admin-header.php';
?>

<div class="admin-card">
  <div class="admin-card-head"><h3>Create Category</h3><a href="index.php" class="link">← Back</a></div>
  <?php if ($err): ?><div class="alert alert-error"><?php echo htmlspecialchars($err); ?></div><?php endif; ?>
  <form method="post" enctype="multipart/form-data" class="admin-form">
    <label>Name</label>
    <input type="text" name="name" required>
    <label>Image (optional)</label>
    <input type="file" name="image" accept="image/*">
    <div style="display:flex;gap:12px;margin-top:8px;">
      <button type="submit" class="btn-primary">Save Category</button>
      <a href="index.php" class="btn-outline">Cancel</a>
    </div>
  </form>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
