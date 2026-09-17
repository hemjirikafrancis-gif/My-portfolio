<?php
require __DIR__ . '/auth.php';
require_admin();

$id   = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$post = ['title'=>'','slug'=>'','category_id'=>'','author'=>'Borderless Analysts Team','image'=>'','content'=>'','featured'=>0];
$error = '';

if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM posts WHERE id = ?');
    $stmt->execute([$id]);
    $found = $stmt->fetch();
    if (!$found) { header('Location: dashboard.php'); exit; }
    $post = $found;
}

$categories = $pdo->query('SELECT * FROM categories ORDER BY name')->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $post['title']       = trim($_POST['title'] ?? '');
    $post['category_id'] = $_POST['category_id'] !== '' ? (int)$_POST['category_id'] : null;
    $post['author']      = trim($_POST['author'] ?? '') ?: 'Borderless Analysts Team';
    $post['image']       = trim($_POST['image'] ?? '');
    $post['content']     = trim($_POST['content'] ?? '');
    $post['featured']    = isset($_POST['featured']) ? 1 : 0;

    if ($post['title'] === '' || $post['content'] === '') {
        $error = 'Title and content are required.';
    } else {
        $slug = slugify($post['title']);
        // ensure unique slug
        $check = $pdo->prepare('SELECT id FROM posts WHERE slug = ? AND id <> ?');
        $check->execute([$slug, $id]);
        if ($check->fetch()) $slug .= '-' . time();

        if ($post['featured']) $pdo->exec('UPDATE posts SET featured = 0');

        if ($id) {
            $stmt = $pdo->prepare('UPDATE posts SET title=?, slug=?, category_id=?, author=?, image=?, content=?, featured=? WHERE id=?');
            $stmt->execute([$post['title'], $slug, $post['category_id'], $post['author'], $post['image'], $post['content'], $post['featured'], $id]);
            $msg = 'Post updated successfully.';
        } else {
            $stmt = $pdo->prepare('INSERT INTO posts (title, slug, category_id, author, image, content, featured) VALUES (?,?,?,?,?,?,?)');
            $stmt->execute([$post['title'], $slug, $post['category_id'], $post['author'], $post['image'], $post['content'], $post['featured']]);
            $msg = 'Post created successfully.';
        }
        header('Location: dashboard.php?msg=' . urlencode($msg));
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $id ? 'Edit post' : 'Create post' ?> – Borderless Analysts Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../style.css"><link rel="stylesheet" href="../blog.css">
</head>
<body class="admin-body">
  <div class="admin-top">
    <div class="brand">Borderless <span>Admin</span></div>
    <div><a href="dashboard.php">← Dashboard</a><a href="logout.php">Logout</a></div>
  </div>
  <div class="admin-wrap">
    <div class="panel" style="max-width:820px;margin:0 auto;">
      <div class="panel-head"><h3><?= $id ? 'Edit post' : 'Create a new post' ?></h3></div>
      <?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>
      <form method="post">
        <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
        <div class="field"><label>Title</label>
          <input type="text" name="title" value="<?= e($post['title']) ?>" required></div>
        <div class="field"><label>Category</label>
          <select name="category_id">
            <option value="">— none —</option>
            <?php foreach ($categories as $c): ?>
              <option value="<?= (int)$c['id'] ?>" <?= (int)$post['category_id'] === (int)$c['id'] ? 'selected' : '' ?>><?= e($c['name']) ?></option>
            <?php endforeach; ?>
          </select></div>
        <div class="field"><label>Author</label>
          <input type="text" name="author" value="<?= e($post['author']) ?>"></div>
        <div class="field"><label>Image path or URL (optional)</label>
          <input type="text" name="image" value="<?= e($post['image']) ?>" placeholder="images/img-9.jpg"></div>
        <div class="field"><label>Content</label>
          <textarea name="content" required><?= e($post['content']) ?></textarea></div>
        <div class="field">
          <label style="display:flex;align-items:center;gap:8px;font-weight:600;">
            <input type="checkbox" name="featured" value="1" style="width:auto" <?= $post['featured'] ? 'checked' : '' ?>>
            Show as featured article on the blog page
          </label>
        </div>
        <button class="btn btn-primary" type="submit"><?= $id ? 'Save changes' : 'Publish post' ?></button>
        <a class="btn" href="dashboard.php" style="margin-left:8px;">Cancel</a>
      </form>
    </div>
  </div>
</body>
</html>
