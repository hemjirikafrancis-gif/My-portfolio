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
    FROM invoices i JOIN clients c ON c.id = i.client_id
    WHERE i.id=? AND i.user_id=?
");
$stmt->execute([$id, $userId]);
$invoice = $stmt->fetch();
if (!$invoice) exit('Invoice not found.');

$iStmt = $pdo->prepare("SELECT * FROM invoice_items WHERE invoice_id=? ORDER BY id");
$iStmt->execute([$id]);
$items = $iStmt->fetchAll();
$user  = getCurrentUser($pdo);
$currency = $user['currency_symbol'] ?? '$';
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Invoice <?= e($invoice['invoice_number']) ?></title>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Outfit',sans-serif;font-size:13px;color:#1e293b;background:#fff;padding:48px}
.no-print{text-align:center;margin-bottom:28px}
.print-btn{background:#2563eb;color:#fff;border:none;padding:11px 28px;border-radius:8px;cursor:pointer;font-family:'Outfit',sans-serif;font-size:14px;font-weight:600}
.pdf-head{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:44px}
.co-name{font-size:22px;font-weight:700;color:#0f172a;margin-bottom:6px}
.co-sub{color:#64748b;line-height:1.8;font-size:13px}
.inv-label{font-family:'JetBrains Mono',monospace;font-size:28px;font-weight:600;color:#2563eb;text-align:right}
.inv-meta{text-align:right;margin-top:8px;color:#64748b;line-height:1.9;font-size:13px}
.inv-meta strong{color:#1e293b}
.bill-box{background:#f8fafc;border-radius:10px;padding:18px 22px;margin-bottom:32px;display:inline-block;min-width:260px}
.bill-lbl{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:#94a3b8;margin-bottom:8px}
.bill-name{font-size:16px;font-weight:700;color:#0f172a;margin-bottom:4px}
.bill-sub{color:#64748b;line-height:1.7}
table{width:100%;border-collapse:collapse;margin-bottom:28px}
thead th{background:#0f172a;color:#fff;padding:11px 16px;text-align:left;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em}
tbody td{padding:12px 16px;border-bottom:1px solid #e2e8f0;font-size:13px}
tbody tr:nth-child(even) td{background:#f8fafc}
tbody tr:last-child td{border-bottom:none}
.totals{display:flex;justify-content:flex-end;margin-bottom:28px}
.totals-inner{width:280px}
.t-row{display:flex;justify-content:space-between;padding:7px 0;border-bottom:1px solid #e2e8f0;font-size:14px}
.t-row:last-child{border-bottom:none}
.t-grand{font-size:17px;font-weight:700;color:#2563eb;padding-top:12px}
.notes-box{background:#eff6ff;border-left:3px solid #2563eb;padding:16px 20px;border-radius:4px}
.notes-lbl{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:#2563eb;margin-bottom:6px}
.footer-line{text-align:center;color:#94a3b8;font-size:11px;margin-top:52px;padding-top:18px;border-top:1px solid #e2e8f0}
@media print{.no-print{display:none}body{padding:24px}}
</style>
</head>
<body>
<div class="no-print">
    <button class="print-btn" onclick="window.print()">&#128438;&nbsp; Print / Save as PDF</button>
</div>

<div class="pdf-head">
    <div>
        <div class="co-name"><?= $user['company_name'] ? e($user['company_name']) : e($user['name']) ?></div>
        <div class="co-sub">
            <?= $user['company_name'] ? e($user['name']).'<br>' : '' ?>
            <?= !empty($user['address'])  ? nl2br(e($user['address'])).'<br>' : '' ?>
            <?= !empty($user['phone'])    ? e($user['phone']).'<br>'          : '' ?>
            <?= e($user['email']) ?>
        </div>
    </div>
    <div>
        <div class="inv-label">INVOICE</div>
        <div class="inv-meta">
            <strong><?= e($invoice['invoice_number']) ?></strong><br>
            Issued: <?= date('F j, Y', strtotime($invoice['issue_date'])) ?><br>
            Due: <?= date('F j, Y', strtotime($invoice['due_date'])) ?>
        </div>
    </div>
</div>

<div class="bill-box">
    <div class="bill-lbl">Bill To</div>
    <div class="bill-name"><?= e($invoice['client_name']) ?></div>
    <div class="bill-sub">
        <?= $invoice['client_email']   ? e($invoice['client_email']).'<br>'              : '' ?>
        <?= $invoice['client_phone']   ? e($invoice['client_phone']).'<br>'              : '' ?>
        <?= $invoice['client_address'] ? nl2br(e($invoice['client_address']))             : '' ?>
    </div>
</div>

<table>
    <thead><tr><th>Description</th><th>Qty</th><th>Unit Price</th><th>Amount</th></tr></thead>
    <tbody>
        <?php foreach ($items as $item): ?>
        <tr>
            <td><?= e($item['description']) ?></td>
            <td><?= $item['quantity']+0 ?></td>
            <td><?= formatMoney((float)$item['unit_price'], $currency) ?></td>
            <td><?= formatMoney((float)$item['amount'], $currency) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="totals">
    <div class="totals-inner">
        <div class="t-row"><span>Subtotal</span><span><?= formatMoney((float)$invoice['subtotal'], $currency) ?></span></div>
        <?php if ($invoice['tax_rate'] > 0): ?>
        <div class="t-row"><span>Tax (<?= $invoice['tax_rate']+0 ?>%)</span><span><?= formatMoney((float)$invoice['tax_amount'], $currency) ?></span></div>
        <?php endif; ?>
        <?php if (!empty($invoice['discount']) && $invoice['discount'] > 0): ?>
        <div class="t-row"><span>Discount</span><span>-<?= formatMoney((float)$invoice['discount'], $currency) ?></span></div>
        <?php endif; ?>
        <div class="t-row t-grand"><span>Total Due</span><span><?= formatMoney((float)$invoice['total'], $currency) ?></span></div>
    </div>
</div>

<?php if ($invoice['notes']): ?>
<div class="notes-box">
    <div class="notes-lbl">Notes</div>
    <?= nl2br(e($invoice['notes'])) ?>
</div>
<?php endif; ?>

<div class="footer-line">Thank you for your business!</div>
</body>
</html>
