<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';
requireLogin();

$uid = $_SESSION['user_id'];

$statQuery = $pdo->prepare("
    SELECT
        COUNT(*) AS total,
        SUM(CASE WHEN status='paid'    THEN 1 ELSE 0 END) AS paid,
        SUM(CASE WHEN status='pending' THEN 1 ELSE 0 END) AS pending,
        SUM(CASE WHEN status='overdue' THEN 1 ELSE 0 END) AS overdue,
        SUM(CASE WHEN status='draft'   THEN 1 ELSE 0 END) AS draft,
        SUM(CASE WHEN status='paid'    THEN total ELSE 0 END) AS revenue,
        SUM(CASE WHEN status IN ('pending','overdue') THEN total ELSE 0 END) AS outstanding
    FROM invoices WHERE user_id = ?
");
$statQuery->execute([$uid]);
$stats = $statQuery->fetch();

$recent = $pdo->prepare("
    SELECT i.*, c.name AS client_name
    FROM invoices i
    JOIN clients c ON c.id = i.client_id
    WHERE i.user_id = ?
    ORDER BY i.created_at DESC
    LIMIT 6
");
$recent->execute([$uid]);
$recentInvoices = $recent->fetchAll();

$cCount = $pdo->prepare("SELECT COUNT(*) FROM clients WHERE user_id = ?");
$cCount->execute([$uid]);
$clientCount = $cCount->fetchColumn();

$user      = getCurrentUser($pdo);
$currency  = $user['currency_symbol'] ?? '$';
$pageTitle = 'Dashboard';
include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h2 class="page-title">Dashboard</h2>
        <p class="page-subtitle">Here's what's happening with your invoices</p>
    </div>
    <a href="/invoice-generator/create_invoice.php" class="btn btn-primary">
        <i class="fas fa-plus"></i> New Invoice
    </a>
</div>

<div class="stats-grid">
    <div class="stat-card stat-blue">
        <div class="stat-icon"><i class="fas fa-file-invoice"></i></div>
        <div class="stat-body">
            <span class="stat-value"><?= $stats['total'] ?? 0 ?></span>
            <span class="stat-label">Total Invoices</span>
        </div>
    </div>
    <div class="stat-card stat-green">
        <div class="stat-icon"><i class="fas fa-circle-check"></i></div>
        <div class="stat-body">
            <span class="stat-value"><?= formatMoney($stats['revenue'] ?? 0, $currency) ?></span>
            <span class="stat-label">Revenue Collected</span>
        </div>
    </div>
    <div class="stat-card stat-yellow">
        <div class="stat-icon"><i class="fas fa-clock"></i></div>
        <div class="stat-body">
            <span class="stat-value"><?= formatMoney($stats['outstanding'] ?? 0, $currency) ?></span>
            <span class="stat-label">Outstanding</span>
        </div>
    </div>
    <div class="stat-card stat-purple">
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div class="stat-body">
            <span class="stat-value"><?= $clientCount ?></span>
            <span class="stat-label">Clients</span>
        </div>
    </div>
</div>

<div class="row-2col">
    <div class="card">
        <div class="card-header"><h3 class="card-title">Invoice Status</h3></div>
        <div class="card-body">
            <div class="status-bars">
                <?php
                $statuses = [
                    ['label'=>'Paid',    'count'=>$stats['paid']    ?? 0, 'class'=>'bar-green'],
                    ['label'=>'Pending', 'count'=>$stats['pending'] ?? 0, 'class'=>'bar-amber'],
                    ['label'=>'Overdue', 'count'=>$stats['overdue'] ?? 0, 'class'=>'bar-red'],
                    ['label'=>'Draft',   'count'=>$stats['draft']   ?? 0, 'class'=>'bar-gray'],
                ];
                $total = max(1, $stats['total'] ?? 1);
                foreach ($statuses as $s):
                    $pct = round(($s['count'] / $total) * 100);
                ?>
                <div class="status-bar-item">
                    <div class="status-bar-label">
                        <span><?= $s['label'] ?></span>
                        <span><?= $s['count'] ?></span>
                    </div>
                    <div class="progress-bar-track">
                        <div class="progress-bar-fill <?= $s['class'] ?>" style="width:<?= $pct ?>%"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h3 class="card-title">Quick Actions</h3></div>
        <div class="card-body">
            <div class="quick-actions">
                <a href="/invoice-generator/create_invoice.php" class="quick-action-btn qa-blue">
                    <i class="fas fa-plus-circle"></i><span>New Invoice</span>
                </a>
                <a href="/invoice-generator/clients.php" class="quick-action-btn qa-green">
                    <i class="fas fa-user-plus"></i><span>Add Client</span>
                </a>
                <a href="/invoice-generator/invoices.php?status=overdue" class="quick-action-btn qa-red">
                    <i class="fas fa-triangle-exclamation"></i><span>View Overdue</span>
                </a>
                <a href="/invoice-generator/invoices.php?status=pending" class="quick-action-btn qa-amber">
                    <i class="fas fa-clock"></i><span>Pending</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Recent Invoices</h3>
        <a href="/invoice-generator/invoices.php" class="btn btn-secondary btn-sm">View All</a>
    </div>
    <div class="card-body p-0">
        <?php if (empty($recentInvoices)): ?>
            <div class="empty-state">
                <i class="fas fa-file-invoice"></i>
                <p>No invoices yet. <a href="/invoice-generator/create_invoice.php">Create your first one!</a></p>
            </div>
        <?php else: ?>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Invoice #</th><th>Client</th><th>Date</th><th>Due</th><th>Amount</th><th>Status</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentInvoices as $inv): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($inv['invoice_number']) ?></strong></td>
                        <td><?= htmlspecialchars($inv['client_name']) ?></td>
                        <td><?= fmtDate($inv['issue_date']) ?></td>
                        <td><?= fmtDate($inv['due_date']) ?></td>
                        <td><strong><?= formatMoney($inv['total'], $currency) ?></strong></td>
                        <td><?= statusBadge($inv['status']) ?></td>
                        <td>
                            <div class="action-btns">
                                <a href="/invoice-generator/preview_invoice.php?id=<?= $inv['id'] ?>" class="btn btn-xs btn-secondary" title="Preview"><i class="fas fa-eye"></i></a>
                                <a href="/invoice-generator/edit_invoice.php?id=<?= $inv['id'] ?>"    class="btn btn-xs btn-secondary" title="Edit"><i class="fas fa-pen"></i></a>
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

<?php include 'includes/footer.php'; ?>
