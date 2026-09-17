<?php
$active='testimonials'; $adminTitle='Edit Testimonial';
require_once __DIR__ . '/../../auth.php';
include __DIR__ . '/../../db.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: index.php'); exit; }

$row = null;
$q = $conn->prepare('SELECT * FROM testimonials WHERE id = ?');
$q->bind_param('i', $id);
$q->execute();
$res = $q->get_result();
if ($res) $row = $res->fetch_assoc();
$q->close();
if (!$row) { header('Location: index.php'); exit; }

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author_name = trim($_POST['author_name'] ?? '');
    $author_role = trim($_POST['author_role'] ?? 'Client');
    $email       = trim($_POST['email'] ?? '');
    $message     = trim($_POST['message'] ?? '');
    $approved    = isset($_POST['approved']) ? 1 : 0;
    $path        = $row['image'];

    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/../../uploads/';
        if (!is_dir($uploadDir)) { mkdir($uploadDir, 0775, true); }
        $allowed = ['image/jpeg','image/png','image/webp'];
        $mime = mime_content_type($_FILES['image']['tmp_name']);
        if (!in_array($mime, $allowed)) {
            $err = 'Image must be JPEG, PNG, or WEBP.';
        } else {
            $name = time() . '_' . preg_replace('/[^a-zA-Z0-9_.-]/', '_', basename($_FILES['image']['name']));
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $name)) {
                if (!empty($row['image']) && strpos($row['image'], 'uploads/') === 0) {
                    @unlink(__DIR__ . '/../../' . $row['image']);
                }
                $path = 'uploads/' . $name;
            }
        }
    }

    if (!$err) {
        if ($author_name === '' || $message === '') {
            $err = 'Author name and message are required.';
        } else {
            if ($author_role === '') $author_role = 'Client';
            $s = $conn->prepare('UPDATE testimonials SET author_name=?, author_role=?, email=?, image=?, message=?, approved=? WHERE id=?');
            $s->bind_param('sssssii', $author_name, $author_role, $email, $path, $message, $approved, $id);
            if ($s->execute()) { header('Location: index.php?approved=1'); exit; }
            $err = 'Failed to update testimonial.';
        }
    }
    // refresh row with submitted values for re-render
    $row = array_merge($row, [
      'author_name'=>$author_name,'author_role'=>$author_role,'email'=>$email,
      'message'=>$message,'approved'=>$approved,'image'=>$path
    ]);
}

include __DIR__ . '/../includes/admin-header.php';
?>

<div class="admin-card">
  <div class="admin-card-head"><h3>Edit Testimonial</h3><a href="index.php" class="link">← Back</a></div>

  <?php if ($err): ?><div class="alert alert-error"><?php echo htmlspecialchars($err); ?></div><?php endif; ?>

  <form method="post" enctype="multipart/form-data" class="admin-form">
    <label>Author Name *</label>
    <input type="text" name="author_name" required value="<?php echo htmlspecialchars($row['author_name']); ?>">

    <label>Role / Company</label>
    <input type="text" name="author_role" value="<?php echo htmlspecialchars($row['author_role']); ?>">

    <label>Email</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($row['email'] ?? ''); ?>">

    <label>Photo</label>
    <?php if (!empty($row['image'])): ?>
      <div style="margin:6px 0;"><img src="../../<?php echo htmlspecialchars($row['image']); ?>" alt="" style="width:80px;height:80px;border-radius:50%;object-fit:cover;"></div>
    <?php endif; ?>
    <input type="file" name="image" accept="image/jpeg,image/png,image/webp">

    <label>Testimonial Message *</label>
    <textarea name="message" rows="6" required maxlength="1000"><?php echo htmlspecialchars($row['message']); ?></textarea>

    <label style="display:flex;align-items:center;gap:8px;margin-top:8px;">
      <input type="checkbox" name="approved" value="1" <?php echo ((int)$row['approved']===1?'checked':''); ?>> Published (visible on homepage)
    </label>

    <div style="display:flex;gap:12px;margin-top:8px;">
      <button type="submit" class="btn-primary">Update Testimonial</button>
      <a href="index.php" class="btn-outline">Cancel</a>
    </div>
  </form>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
