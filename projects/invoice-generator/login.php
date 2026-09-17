<?php
/**
 * Login & Registration — register.php merged here via tabs.
 * POST action='login'    → authenticate user
 * POST action='register' → create new account
 */
require_once 'includes/auth.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';

if (isLoggedIn()) redirect('/invoice-generator/dashboard.php');

$error   = '';
$success = '';
$tab     = $_GET['tab'] ?? 'login';

// ── Handle LOGIN ──────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'login') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        $error = 'Please fill in all fields.';
        $tab   = 'login';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            loginUser($user);
            redirect('/invoice-generator/dashboard.php');
        } else {
            $error = 'Invalid email or password.';
            $tab   = 'login';
        }
    }
}

// ── Handle REGISTER ───────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'register') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $pass    = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    $tab     = 'register';

    if (!$name || !$email || !$pass || !$confirm) {
        $error = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (strlen($pass) < 6) {
        $error = 'Password must be at least 6 characters.';
    } elseif ($pass !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        $chk = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $chk->execute([$email]);
        if ($chk->fetch()) {
            $error = 'An account with that email already exists.';
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)")
                ->execute([$name, $email, $hash]);
            $success = 'Account created successfully! You can now sign in.';
            $tab     = 'login';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InvoiceFlow — Sign In</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/invoice-generator/assets/css/style.css">
</head>
<body class="auth-body">

<div class="auth-wrapper">
    <div class="auth-brand">
        <div class="brand-icon-lg">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/>
            </svg>
        </div>
        <h1>InvoiceFlow</h1>
        <p>Professional invoicing, simplified</p>
    </div>

    <div class="auth-card">
        <div class="auth-tabs">
            <button class="auth-tab <?= $tab === 'login'    ? 'active' : '' ?>" onclick="switchTab('login')">Sign In</button>
            <button class="auth-tab <?= $tab === 'register' ? 'active' : '' ?>" onclick="switchTab('register')">Create Account</button>
        </div>

        <?php if ($error):   ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>
        <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>

        <!-- LOGIN FORM -->
        <form id="form-login" class="auth-form <?= $tab === 'login' ? '' : 'hidden' ?>" method="POST">
            <input type="hidden" name="action" value="login">
            <div class="form-group">
                <label for="login-email">Email Address</label>
                <input type="email" id="login-email" name="email" placeholder="you@example.com" required autocomplete="email">
            </div>
            <div class="form-group">
                <label for="login-password">Password</label>
                <input type="password" id="login-password" name="password" placeholder="••••••••" required autocomplete="current-password">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </form>

        <!-- REGISTER FORM -->
        <form id="form-register" class="auth-form <?= $tab === 'register' ? '' : 'hidden' ?>" method="POST">
            <input type="hidden" name="action" value="register">
            <div class="form-group">
                <label for="reg-name">Full Name</label>
                <input type="text" id="reg-name" name="name" placeholder="Jane Smith" required>
            </div>
            <div class="form-group">
                <label for="reg-email">Email Address</label>
                <input type="email" id="reg-email" name="email" placeholder="you@example.com" required>
            </div>
            <div class="form-group">
                <label for="reg-pass">Password</label>
                <input type="password" id="reg-pass" name="password" placeholder="Minimum 6 characters" required>
            </div>
            <div class="form-group">
                <label for="reg-confirm">Confirm Password</label>
                <input type="password" id="reg-confirm" name="confirm_password" placeholder="Repeat password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Create Account</button>
        </form>
    </div>
</div>

<script>
function switchTab(tab) {
    document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.auth-form').forEach(f => f.classList.add('hidden'));
    document.getElementById('form-' + tab).classList.remove('hidden');
    event.currentTarget.classList.add('active');
}
</script>
</body>
</html>
