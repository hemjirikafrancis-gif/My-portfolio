<?php
$active='testimonials'; $adminTitle='New Testimonial';
require_once __DIR__ . '/../../auth.php';
include __DIR__ . '/../../db.php';

$conn->query("CREATE TABLE IF NOT EXISTS testimonials (
  id INT AUTO_INCREMENT PRIMARY KEY,
  author_name VARCHAR(150) NOT NULL,
  author_role VARCHAR(150) DEFAULT 'Client',
  email VARCHAR(180) DEFAULT NULL,
  image VARCHAR(255) DEFAULT NULL,
  message TEXT NOT NULL,
  approved TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author_name = trim($_POST['author_name'] ?? '');
    $author_role = trim($_POST['author_role'] ?? 'Client');
    $email       = trim($_POST['email'] ?? '');
    $message     = trim($_POST['message'] ?? '');
    $approved    = isset($_POST['approved']) ? 1 : 0;
    $path = '';

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
                $path = 'uploads/' . $name;
            }
        }
    }

    if (!$err) {
        if ($author_name === '' || $message === '') {
            $err = 'Author name and message are required.';
        } else {
            if ($author_role === '') $author_role = 'Client';
            $s = $conn->prepare('INSERT INTO testimonials(author_name,author_role,email,image,message,approved) VALUES(?,?,?,?,?,?)');
            $s->bind_param('sssssi', $author_name, $author_role, $email, $path, $message, $approved);
            if ($s->execute()) { header('Location: index.php?approved=1'); exit; }
            $err = 'Failed to save testimonial.';
        }
    }
}

include __DIR__ . '/../includes/admin-header.php';
?>

<div class="admin-card">
  <div class="admin-card-head"><h3>Create New Testimonial</h3><a href="index.php" class="link">← Back</a></div>

  <?php if ($err): ?><div class="alert alert-error"><?php echo htmlspecialchars($err); ?></div><?php endif; ?>

  <form method="post" enctype="multipart/form-data" class="admin-form">
    <label>Author Name *</label>
    <input type="text" name="author_name" required>

    <label>Role / Company</label>
    <input type="text" name="author_role" placeholder="e.g. Corporate Client">

    <label>Email (optional)</label>
    <input type="email" name="email">

    <label>Photo (optional)</label>
    <input type="file" name="image" accept="image/jpeg,image/png,image/webp">

    <label>Testimonial Message *</label>
    <textarea name="message" rows="6" required maxlength="1000"></textarea>

    <label style="display:flex;align-items:center;gap:8px;margin-top:8px;">
      <input type="checkbox" name="approved" value="1" checked> Publish immediately (show on homepage)
    </label>

    <div style="display:flex;gap:12px;margin-top:8px;">
      <button type="submit" class="btn-primary">Save Testimonial</button>
      <a href="index.php" class="btn-outline">Cancel</a>
    </div>
  </form>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
