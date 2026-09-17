<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';
requireLogin();

$pageTitle = 'Settings';
$userId    = currentUserId();
$user      = getCurrentUser($pdo);
$errors    = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'profile') {
        $name    = trim($_POST['name']         ?? '');
        $company = trim($_POST['company_name'] ?? '');
        $address = trim($_POST['address']      ?? '');
        $phone   = trim($_POST['phone']        ?? '');
        if (!$name) { $errors[] = 'Name is required.'; }
        else {
            $pdo->prepare("UPDATE users SET name=?,company_name=?,address=?,phone=? WHERE id=?")
                ->execute([$name,$company,$address,$phone,$userId]);
            flash('success','Profile updated successfully.');
            redirect('/invoice-generator/settings.php');
        }
    }

    if ($action === 'password') {
        $current = $_POST['current_password'] ?? '';
        $new     = $_POST['new_password']     ?? '';
        $confirm = $_POST['confirm_password'] ?? '';
        if (!$current||!$new||!$confirm)           { $errors[] = 'Please fill in all password fields.'; }
        elseif (!password_verify($current,$user['password'])) { $errors[] = 'Current password is incorrect.'; }
        elseif (strlen($new) < 6)                  { $errors[] = 'New password must be at least 6 characters.'; }
        elseif ($new !== $confirm)                  { $errors[] = 'New passwords do not match.'; }
        else {
            $pdo->prepare("UPDATE users SET password=? WHERE id=?")
                ->execute([password_hash($new, PASSWORD_DEFAULT), $userId]);
            flash('success','Password changed successfully.');
            redirect('/invoice-generator/settings.php');
        }
    }
}

include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h2 class="page-title">Settings</h2>
        <p class="page-subtitle">Manage your profile and account</p>
    </div>
</div>

<?php if ($errors): ?>
<div class="alert alert-danger">
    <?php foreach($errors as $err): ?><p><?= e($err) ?></p><?php endforeach; ?>
    <button class="alert-close" onclick="this.parentElement.remove()">&times;</button>
</div>
<?php endif; ?>

<div class="settings-grid">
    <div class="card">
        <div class="card-header"><h3 class="card-title">Profile &amp; Company</h3></div>
        <div class="card-body">
            <form method="POST">
                <input type="hidden" name="action" value="profile">
                <div class="form-group">
                    <label class="form-label">Your Name <span class="required">*</span></label>
                    <input type="text" name="name" class="form-control" value="<?= e($user['name']) ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Company Name</label>
                    <input type="text" name="company_name" class="form-control" value="<?= e($user['company_name'] ?? '') ?>" placeholder="Appears on all invoices">
                </div>
                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="tel" name="phone" class="form-control" value="<?= e($user['phone'] ?? '') ?>" placeholder="+1 555 000 0000">
                </div>
                <div class="form-group">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="3" placeholder="Street, City, Country"><?= e($user['address'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save Profile</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h3 class="card-title">Change Password</h3></div>
        <div class="card-body">
            <form method="POST">
                <input type="hidden" name="action" value="password">
                <div class="form-group">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="current_password" class="form-control" placeholder="••••••••">
                </div>
                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input type="password" name="new_password" class="form-control" placeholder="Minimum 6 characters">
                </div>
                <div class="form-group">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Repeat new password">
                </div>
                <button type="submit" class="btn btn-primary">Update Password</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h3 class="card-title">Account Info</h3></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" value="<?= e($user['email']) ?>" disabled>
                <small class="text-muted">Email cannot be changed.</small>
            </div>
            <div class="form-group">
                <label class="form-label">Member Since</label>
                <input type="text" class="form-control" value="<?= date('F j, Y', strtotime($user['created_at'])) ?>" disabled>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
