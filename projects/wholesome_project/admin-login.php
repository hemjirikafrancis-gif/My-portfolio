<?php
session_start();
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_POST['username'] ?? '') === 'admin' && ($_POST['password'] ?? '') === 'Admin123') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard/index.php');
        exit;
    }
    $err = 'Invalid credentials. Please try again.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login – Wholesome Legal House</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>
<body class="login-body">
  <div class="login-wrap">
    <div class="login-card">
      <a href="index.php" class="login-logo">
        <img src="Images/cropped-headerlogo-1.png" alt="Wholesome Legal House" />
      </a>
      <span class="section-label">Admin Area</span>
      <h2>Sign in to your <em>dashboard</em></h2>
      <p class="login-sub">Enter your credentials to manage posts and categories.</p>

      <?php if ($err): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($err); ?></div>
      <?php endif; ?>

      <form method="post" class="login-form">
        <label>Username</label>
        <input name="username" type="text" placeholder="admin" required autofocus>
        <label>Password</label>
        <input name="password" type="password" placeholder="••••••••" required>
        <button type="submit" class="btn-primary" style="width:100%;margin-top:8px;">Sign In</button>
      </form>

      <p class="login-back"><a href="index.php">← Back to website</a></p>
    </div>
  </div>
</body>
</html>
