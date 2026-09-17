<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';

if (isAdminLoggedIn()) { header('Location: dashboard.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (adminLogin($_POST['username'] ?? '', $_POST['password'] ?? '')) {
        header('Location: dashboard.php'); exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>E.A.S. Admin — Login</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Mono:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="auth-body">
<div class="auth-card">
  <div class="auth-logo">⏱ <span>E.A.S.</span></div>
  <h1>Admin Login</h1>
  <p class="auth-sub">Employee Attendance System</p>
  <?php if($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="POST">
    <div class="field">
      <label>Username</label>
      <input type="text" name="username" required autofocus placeholder="admin">
    </div>
    <div class="field">
      <label>Password</label>
      <input type="password" name="password" required placeholder="••••••••">
    </div>
    <button type="submit" class="btn-submit">Sign In →</button>
  </form>
  <a href="../index.php" class="back-link">← Back to Terminal</a>
</div>
</body>
</html>
