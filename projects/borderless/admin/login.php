<?php
require __DIR__ . '/auth.php';
if (admin_logged_in()) { header('Location: dashboard.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        session_regenerate_id(true);
        $_SESSION['admin_id']   = $admin['id'];
        $_SESSION['admin_name'] = $admin['full_name'];
        header('Location: dashboard.php');
        exit;
    }
    $error = 'Incorrect username or password.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login – Borderless Analysts</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../style.css"><link rel="stylesheet" href="../blog.css">
</head>
<body class="admin-body">
  <div class="auth-shell">
    <div class="auth-card">
      <h1>Admin Login</h1>
      <p class="sub">Sign in to manage the Borderless Analysts blog.</p>
      <?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>
      <form method="post">
        <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
        <div class="field"><label>Username</label><input type="text" name="username" required autofocus></div>
        <div class="field"><label>Password</label><input type="password" name="password" required></div>
        <button class="btn btn-primary" style="width:100%;justify-content:center;" type="submit">Sign in →</button>
      </form>
      <p style="margin-top:18px;font-size:.82rem;color:#7a8794;text-align:center;">
        Default credentials: <b>admin</b> / <b>admin123</b><br>Change the password after your first login.
      </p>
      <p style="margin-top:10px;text-align:center;"><a href="../blog.php" style="font-size:.85rem;">← Back to website</a></p>
    </div>
  </div>
</body>
</html>
