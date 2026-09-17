<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';
requireLogin();

$userId = currentUserId();
$id     = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("
    SELECT i.*, c.name AS client_name, c.email AS client_email,
           c.phone AS client_phone, c.address AS client_address
    FROM invoices i
    JOIN clients c ON c.id = i.client_id
    WHERE i.id=? AND i.user_id=?
");
$stmt->execute([$id, $userId]);
$invoice = $stmt->fetch();
if (!$invoice) { flash('error', 'Invoice not found.'); redirect('/invoice-generator/invoices.php'); }

$iStmt = $pdo->prepare("SELECT * FROM invoice_items WHERE invoice_id=? ORDER BY id");
$iStmt->execute([$id]);
$items = $iStmt->fetchAll();

$user      = getCurrentUser($pdo);
$currency  = $user['currency_symbol'] ?? '$';
$pageTitle = 'Invoice ' . $invoice['invoice_number'];

// Send handler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'send') {
    $to = $invoice['client_email'];
    if (!$to) {
        flash('error', 'This client has no email address saved.');
    } else {
        $sender  = $user['company_name'] ?: $user['name'];
        $subject = "Invoice {$invoice['invoice_number']} from {$sender}";
        $body    = "Dear {$invoice['client_name']},\n\nPlease find your invoice below.\n\n"
                 . "Invoice #: {$invoice['invoice_number']}\n"
                 . "Amount Due: " . formatMoney((float)$invoice['total'], $currency) . "\n"
                 . "Due Date: " . date('F j, Y', strtotime($invoice['due_date'])) . "\n\n"
                 . "Thank you for your business!\n\n{$sender}";
        $headers = "From: {$sender} <{$user['email']}>\r\nContent-Type: text/plain; charset=UTF-8";
        if (mail($to, $subject, $body, $headers)) {
            flash('success', 'Invoice sent to ' . $to . '.');
        } else {
            flash('error', 'Mail failed. Check your server mail() configuration.');
        }
    }
    redirect('/invoice-generator/preview_invoice.php?id=' . $id);
}

include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h2 class="page-title"><?= e($invoice['invoice_number']) ?></h2>
        <p class="page-subtitle"><?= statusBadge($invoice['status']) ?></p>
    </div>
    <div class="btn-group">
        <a href="/invoice-generator/edit_invoice.php?id=<?= $id ?>" class="btn btn-secondary"><i class="fas fa-pen"></i> Edit</a>
        <a href="/invoice-generator/download_pdf.php?id=<?= $id ?>" class="btn btn-secondary" target="_blank"><i class="fas fa-download"></i> PDF</a>
        <?php if ($invoice['client_email']): ?>
        <form method="POST" style="display:inline">
            <input type="hidden" name="action" value="send">
            <button type="submit" class="btn btn-primary"
                onclick="return confirm('Send invoice to <?= e($invoice['client_email']) ?>?')">
                <i class="fas fa-envelope"></i> Send to Client
            </button>
        </form>
        <?php endif; ?>
        <a href="/invoice-generator/invoices.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
</div>

<div class="card invoice-preview">
    <div class="inv-head">
        <div class="inv-from">
            <?php if (!empty($user['company_name'])): ?>
                <div class="inv-company"><?= e($user['company_name']) ?></div>
            <?php endif; ?>
            <div style="font-weight:600"><?= e($user['name']) ?></div>
            <?php if (!empty($user['address'])): ?><div class="text-muted"><?= nl2br(e($user['address'])) ?></div><?php endif; ?>
            <?php if (!empty($user['phone'])): ?><div class="text-muted"><?= e($user['phone']) ?></div><?php endif; ?>
            <div class="text-muted"><?= e($user['email']) ?></div>
        </div>
        <div class="inv-meta">
            <div class="inv-number-display"><?= e($invoice['invoice_number']) ?></div>
            <table class="meta-table">
                <tr><td>Issued:</td><td><?= date('M d, Y', strtotime($invoice['issue_date'])) ?></td></tr>
                <tr><td>Due:</td>   <td><?= date('M d, Y', strtotime($invoice['due_date']))   ?></td></tr>
                <tr><td>Status:</td><td><?= statusBadge($invoice['status']) ?></td></tr>
            </table>
        </div>
    </div>

    <div class="inv-bill-to">
        <div class="bill-label">Bill To</div>
        <div class="bill-name"><?= e($invoice['client_name']) ?></div>
        <?php if ($invoice['client_email']): ?>   <div><?= e($invoice['client_email']) ?></div>  <?php endif; ?>
        <?php if ($invoice['client_phone']): ?>   <div><?= e($invoice['client_phone']) ?></div>  <?php endif; ?>
        <?php if ($invoice['client_address']): ?> <div class="text-muted"><?= nl2br(e($invoice['client_address'])) ?></div> <?php endif; ?>
    </div>

    <div class="table-wrapper">
    <table class="table items-preview-table">
        <thead><tr><th>Description</th><th>Qty</th><th>Unit Price</th><th>Amount</th></tr></thead>
        <tbody>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?= e($item['description']) ?></td>
                <td><?= $item['quantity'] + 0 ?></td>
                <td><?= formatMoney((float)$item['unit_price'], $currency) ?></td>
                <td><?= formatMoney((float)$item['amount'], $currency) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>

    <div class="inv-totals">
        <div class="inv-totals-inner">
            <div class="inv-total-row"><span>Subtotal</span><span><?= formatMoney((float)$invoice['subtotal'], $currency) ?></span></div>
            <?php if ($invoice['tax_rate'] > 0): ?>
            <div class="inv-total-row">
                <span>Tax (<?= $invoice['tax_rate'] + 0 ?>%)</span>
                <span><?= formatMoney((float)$invoice['tax_amount'], $currency) ?></span>
            </div>
            <?php endif; ?>
            <?php if (isset($invoice['discount']) && $invoice['discount'] > 0): ?>
            <div class="inv-total-row">
                <span>Discount</span>
                <span>-<?= formatMoney((float)$invoice['discount'], $currency) ?></span>
            </div>
            <?php endif; ?>
            <div class="inv-total-row inv-grand-total">
                <span>Total Due</span>
                <span><?= formatMoney((float)$invoice['total'], $currency) ?></span>
            </div>
        </div>
    </div>

    <?php if ($invoice['notes']): ?>
    <div class="inv-notes">
        <strong>Notes</strong>
        <p><?= nl2br(e($invoice['notes'])) ?></p>
    </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
