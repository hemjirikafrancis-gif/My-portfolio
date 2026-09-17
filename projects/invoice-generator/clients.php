<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';
requireLogin();

$pageTitle = 'Clients';
$userId    = currentUserId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action  = $_POST['action'] ?? '';
    $name    = trim($_POST['name']    ?? '');
    $email   = trim($_POST['email']   ?? '');
    $phone   = trim($_POST['phone']   ?? '');
    $address = trim($_POST['address'] ?? '');

    if ($action === 'add') {
        if (!$name) { flash('error', 'Client name is required.'); }
        else {
            $pdo->prepare("INSERT INTO clients (user_id,name,email,phone,address) VALUES (?,?,?,?,?)")
                ->execute([$userId, $name, $email, $phone, $address]);
            flash('success', 'Client added successfully.');
        }
    } elseif ($action === 'edit') {
        $id = (int)$_POST['id'];
        if (!$name) { flash('error', 'Client name is required.'); }
        else {
            $pdo->prepare("UPDATE clients SET name=?,email=?,phone=?,address=? WHERE id=? AND user_id=?")
                ->execute([$name, $email, $phone, $address, $id, $userId]);
            flash('success', 'Client updated.');
        }
    } elseif ($action === 'delete') {
        $id  = (int)$_POST['id'];
        $chk = $pdo->prepare("SELECT COUNT(*) FROM invoices WHERE client_id=? AND user_id=?");
        $chk->execute([$id, $userId]);
        if ($chk->fetchColumn() > 0) {
            flash('error', 'Cannot delete a client that has invoices attached.');
        } else {
            $pdo->prepare("DELETE FROM clients WHERE id=? AND user_id=?")->execute([$id, $userId]);
            flash('success', 'Client deleted.');
        }
    }
    redirect('/invoice-generator/clients.php');
}

$search = trim($_GET['q'] ?? '');
if ($search) {
    $stmt = $pdo->prepare("SELECT * FROM clients WHERE user_id=? AND (name LIKE ? OR email LIKE ?) ORDER BY name");
    $stmt->execute([$userId, "%$search%", "%$search%"]);
} else {
    $stmt = $pdo->prepare("SELECT * FROM clients WHERE user_id=? ORDER BY name");
    $stmt->execute([$userId]);
}
$clients = $stmt->fetchAll();

include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h2 class="page-title">Clients</h2>
        <p class="page-subtitle"><?= count($clients) ?> client<?= count($clients) !== 1 ? 's' : '' ?></p>
    </div>
    <button class="btn btn-primary" onclick="openModal('modal-add')"><i class="fas fa-plus"></i> Add Client</button>
</div>

<div class="card mb-1">
    <div class="card-body">
        <form method="GET" class="filter-row">
            <div class="input-icon flex-1">
                <i class="fas fa-search"></i>
                <input type="text" name="q" value="<?= e($search) ?>" class="form-control" placeholder="Search by name or email...">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <?php if ($search): ?><a href="/invoice-generator/clients.php" class="btn btn-secondary">Clear</a><?php endif; ?>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <?php if (empty($clients)): ?>
        <div class="empty-state">
            <i class="fas fa-users"></i>
            <p>No clients yet. Click <strong>Add Client</strong> to get started.</p>
        </div>
        <?php else: ?>
        <div class="table-wrapper">
        <table class="table">
            <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Actions</th></tr></thead>
            <tbody>
                <?php foreach ($clients as $c): ?>
                <tr>
                    <td><strong><?= e($c['name']) ?></strong></td>
                    <td><?= e($c['email']) ?></td>
                    <td><?= e($c['phone']) ?></td>
                    <td class="text-muted"><?= e($c['address']) ?></td>
                    <td>
                        <div class="action-btns">
                        <button class="btn btn-xs btn-secondary" onclick="openEditModal(
                            <?= $c['id'] ?>,
                            '<?= addslashes(e($c['name'])) ?>',
                            '<?= addslashes(e($c['email'])) ?>',
                            '<?= addslashes(e($c['phone'])) ?>',
                            '<?= addslashes(e($c['address'])) ?>')"><i class="fas fa-pen"></i></button>
                        <form method="POST" style="display:inline" onsubmit="return confirm('Delete this client?')">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id"     value="<?= $c['id'] ?>">
                            <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Add Modal -->
<div id="modal-add" class="modal hidden">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Add New Client</h3>
            <button onclick="closeModal('modal-add')" class="modal-close">&times;</button>
        </div>
        <form method="POST">
            <input type="hidden" name="action" value="add">
            <div class="form-group">
                <label class="form-label">Name <span class="required">*</span></label>
                <input type="text" name="name" class="form-control" required placeholder="Client or company name">
            </div>
            <div class="form-row-2">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="client@example.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="tel" name="phone" class="form-control" placeholder="+1 555 000 0000">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="2" placeholder="Street, City, Country"></textarea>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modal-add')">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Client</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="modal-edit" class="modal hidden">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Edit Client</h3>
            <button onclick="closeModal('modal-edit')" class="modal-close">&times;</button>
        </div>
        <form method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id"     id="edit-id">
            <div class="form-group">
                <label class="form-label">Name <span class="required">*</span></label>
                <input type="text" name="name" id="edit-name" class="form-control" required>
            </div>
            <div class="form-row-2">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" id="edit-email" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="tel" name="phone" id="edit-phone" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Address</label>
                <textarea name="address" id="edit-address" class="form-control" rows="2"></textarea>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modal-edit')">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
