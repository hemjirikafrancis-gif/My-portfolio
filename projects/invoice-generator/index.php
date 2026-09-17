<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';

if (isLoggedIn()) {
    header('Location: /invoice-generator/dashboard.php');
    exit;
}

$errors  = [];
$success = '';
$tab     = 'login';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'login') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if (empty($email) || empty($password)) {
        $errors[] = 'Email and password are required.';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            loginUser($user);
            redirect('/invoice-generator/dashboard.php', 'Welcome back, ' . $user['name'] . '!');
        } else {
            $errors[] = 'Invalid email or password.';
        }
    }
    $tab = 'login';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'register') {
    $name     = clean($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';
    $tab      = 'register';

    if (empty($name) || empty($email) || empty($password)) {
        $errors[] = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    } elseif ($password !== $confirm) {
        $errors[] = 'Passwords do not match.';
    } else {
        $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);
        if ($check->fetch()) {
            $errors[] = 'An account with that email already exists.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)")
                ->execute([$name, $email, $hash]);
            $success = 'Account created! You can now log in.';
            $tab = 'login';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InvoicePro — Sign In</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/invoice-generator/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="auth-layout">
<div class="auth-wrapper">
    <div class="auth-card">

        <div class="auth-brand">
            <div class="auth-brand-icon"><i class="fas fa-file-invoice-dollar"></i></div>
            <h1>InvoicePro</h1>
            <p>Professional invoicing made simple</p>
        </div>

        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $err): ?><p><?= htmlspecialchars($err) ?></p><?php endforeach; ?>
            <button class="alert-close" onclick="this.parentElement.remove()">&times;</button>
        </div>
        <?php endif; ?>
        <?php if ($success): ?>
        <div class="alert alert-success"><p><?= htmlspecialchars($success) ?></p></div>
        <?php endif; ?>

        <div class="auth-tabs">
            <button class="auth-tab <?= $tab==='login'?'active':'' ?>" data-tab="login" onclick="switchTab('login')">Sign In</button>
            <button class="auth-tab <?= $tab==='register'?'active':'' ?>" data-tab="register" onclick="switchTab('register')">Create Account</button>
        </div>

        <form class="auth-form <?= $tab==='login'?'active':'' ?>" id="tab-login" method="POST">
            <input type="hidden" name="action" value="login">
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <div class="input-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control" placeholder="you@example.com"
                           value="<?= $tab==='login' ? htmlspecialchars($_POST['email'] ?? '') : '' ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Your password" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Sign In</button>
        </form>

        <form class="auth-form <?= $tab==='register'?'active':'' ?>" id="tab-register" method="POST">
            <input type="hidden" name="action" value="register">
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <div class="input-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" class="form-control" placeholder="Jane Smith"
                           value="<?= $tab==='register' ? htmlspecialchars($_POST['name'] ?? '') : '' ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <div class="input-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control" placeholder="you@example.com"
                           value="<?= $tab==='register' ? htmlspecialchars($_POST['email'] ?? '') : '' ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Min. 6 characters" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Repeat password" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-user-plus"></i> Create Account</button>
        </form>

    </div>
</div>
<script>
function switchTab(tab) {
    document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.auth-form').forEach(f => f.classList.remove('active'));
    document.querySelector('.auth-tab[data-tab="'+tab+'"]').classList.add('active');
    document.getElementById('tab-' + tab).classList.add('active');
}
</script>
</body>
</html>
