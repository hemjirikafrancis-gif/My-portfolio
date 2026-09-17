<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';
requireLogin();

$uid      = $_SESSION['user_id'];
$user     = getCurrentUser($pdo);
$currency = $user['currency_symbol'] ?? '$';

$status  = $_GET['status']  ?? '';
$search  = trim($_GET['search'] ?? '');
$page    = max(1, (int)($_GET['page'] ?? 1));
$perPage = 10;
$offset  = ($page - 1) * $perPage;

$where  = ['i.user_id = ?'];
$params = [$uid];

if ($status && in_array($status, ['draft','pending','paid','overdue','sent'])) {
    $where[]  = 'i.status = ?';
    $params[] = $status;
}
if ($search) {
    $where[]  = '(i.invoice_number LIKE ? OR c.name LIKE ?)';
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$whereSQL = implode(' AND ', $where);

$countStmt = $pdo->prepare("SELECT COUNT(*) FROM invoices i JOIN clients c ON c.id=i.client_id WHERE $whereSQL");
$countStmt->execute($params);
$total      = $countStmt->fetchColumn();
$totalPages = (int)ceil($total / $perPage);

$fetchParams = array_merge($params, [$perPage, $offset]);
$stmt = $pdo->prepare("
    SELECT i.*, c.name AS client_name
    FROM invoices i
    JOIN clients c ON c.id = i.client_id
    WHERE $whereSQL
    ORDER BY i.created_at DESC
    LIMIT ? OFFSET ?
");
$stmt->execute($fetchParams);
$invoices = $stmt->fetchAll();

$pageTitle = 'Invoices';
include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h2 class="page-title">Invoices</h2>
        <p class="page-subtitle"><?= $total ?> invoice<?= $total !== 1 ? 's' : '' ?> found</p>
    </div>
    <a href="/invoice-generator/create_invoice.php" class="btn btn-primary">
        <i class="fas fa-plus"></i> New Invoice
    </a>
</div>

<div class="card mb-1">
    <div class="card-body">
        <form method="GET" class="filter-row">
            <div class="input-icon flex-1">
                <i class="fas fa-search"></i>
                <input type="text" name="search" class="form-control" placeholder="Search by invoice # or client..."
                       value="<?= htmlspecialchars($search) ?>">
            </div>
            <select name="status" class="form-control" style="max-width:160px">
                <option value="">All Statuses</option>
                <?php foreach (['draft','pending','sent','paid','overdue'] as $s): ?>
                <option value="<?= $s ?>" <?= $status === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
            <?php if ($search || $status): ?>
                <a href="/invoice-generator/invoices.php" class="btn btn-secondary">Clear</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<div class="tab-pills mb-1">
    <a href="/invoice-generator/invoices.php" class="tab-pill <?= !$status ? 'active' : '' ?>">All</a>
    <?php foreach (['pending','paid','overdue','draft'] as $s): ?>
    <a href="/invoice-generator/invoices.php?status=<?= $s ?>" class="tab-pill <?= $status === $s ? 'active' : '' ?>"><?= ucfirst($s) ?></a>
    <?php endforeach; ?>
</div>

<div class="card">
    <div class="card-body p-0">
        <?php if (empty($invoices)): ?>
        <div class="empty-state">
            <i class="fas fa-file-invoice"></i>
            <p>No invoices found. <a href="/invoice-generator/create_invoice.php">Create one now!</a></p>
        </div>
        <?php else: ?>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Client</th>
                        <th>Issue Date</th>
                        <th>Due Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th style="width:160px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoices as $inv):
                        $days = daysUntilDue($inv['due_date']);
                    ?>
                    <tr>
                        <td><a href="/invoice-generator/preview_invoice.php?id=<?= $inv['id'] ?>" class="font-semibold"><?= htmlspecialchars($inv['invoice_number']) ?></a></td>
                        <td><?= htmlspecialchars($inv['client_name']) ?></td>
                        <td><?= fmtDate($inv['issue_date']) ?></td>
                        <td>
                            <?= fmtDate($inv['due_date']) ?>
                            <?php if ($inv['status'] === 'pending' && $days <= 3 && $days >= 0): ?>
                                <span class="badge badge-warning">due soon</span>
                            <?php elseif (!in_array($inv['status'],['paid']) && $days < 0): ?>
                                <span class="badge badge-danger"><?= abs($days) ?>d overdue</span>
                            <?php endif; ?>
                        </td>
                        <td><strong><?= formatMoney($inv['total'], $currency) ?></strong></td>
                        <td><?= statusBadge($inv['status']) ?></td>
                        <td>
                            <div class="action-btns">
                                <a href="/invoice-generator/preview_invoice.php?id=<?= $inv['id'] ?>"  class="btn btn-xs btn-secondary" title="Preview"><i class="fas fa-eye"></i></a>
                                <a href="/invoice-generator/edit_invoice.php?id=<?= $inv['id'] ?>"     class="btn btn-xs btn-secondary" title="Edit"><i class="fas fa-pen"></i></a>
                                <a href="/invoice-generator/download_pdf.php?id=<?= $inv['id'] ?>"     class="btn btn-xs btn-secondary" title="PDF" target="_blank"><i class="fas fa-download"></i></a>
                                <form method="POST" action="/invoice-generator/delete_invoice.php" style="display:inline"
                                      onsubmit="return confirm('Delete invoice <?= htmlspecialchars($inv['invoice_number']) ?>? This cannot be undone.')">
                                    <input type="hidden" name="id" value="<?= $inv['id'] ?>">
                                    <button type="submit" class="btn btn-xs btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if ($totalPages > 1): ?>
        <div class="pagination-wrap">
            <?php for ($p = 1; $p <= $totalPages; $p++): ?>
            <a href="?page=<?= $p ?>&status=<?= urlencode($status) ?>&search=<?= urlencode($search) ?>"
               class="page-btn <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
