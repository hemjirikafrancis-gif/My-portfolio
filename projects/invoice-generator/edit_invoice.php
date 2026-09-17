<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';
requireLogin();

$userId = currentUserId();
$id     = (int)($_GET['id'] ?? 0);
$pageTitle = 'Edit Invoice';

$stmt = $pdo->prepare("SELECT * FROM invoices WHERE id=? AND user_id=?");
$stmt->execute([$id, $userId]);
$invoice = $stmt->fetch();
if (!$invoice) { flash('error', 'Invoice not found.'); redirect('/invoice-generator/invoices.php'); }

$iStmt = $pdo->prepare("SELECT * FROM invoice_items WHERE invoice_id=? ORDER BY id");
$iStmt->execute([$id]);
$items = $iStmt->fetchAll();

$cStmt = $pdo->prepare("SELECT id,name FROM clients WHERE user_id=? ORDER BY name");
$cStmt->execute([$userId]);
$clients = $cStmt->fetchAll();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientId  = (int)($_POST['client_id'] ?? 0);
    $issueDate = $_POST['issue_date'] ?? '';
    $dueDate   = $_POST['due_date']   ?? '';
    $taxRate   = (float)($_POST['tax_rate'] ?? 0);
    $discount  = (float)($_POST['discount'] ?? 0);
    $notes     = trim($_POST['notes'] ?? '');
    $status    = in_array($_POST['status'] ?? '', ['draft','sent','paid','overdue','pending']) ? $_POST['status'] : 'draft';
    $descs     = $_POST['description'] ?? [];
    $qtys      = $_POST['quantity']    ?? [];
    $prices    = $_POST['unit_price']  ?? [];

    if (!$clientId)  $errors[] = 'Please select a client.';
    if (!$issueDate) $errors[] = 'Issue date is required.';
    if (!$dueDate)   $errors[] = 'Due date is required.';

    if (empty($errors)) {
        $subtotal = 0; $newItems = [];
        foreach ($descs as $i => $desc) {
            $desc = trim($desc); if (!$desc) continue;
            $qty    = (float)($qtys[$i]   ?? 1);
            $price  = (float)($prices[$i] ?? 0);
            $amount = round($qty * $price, 2);
            $subtotal += $amount;
            $newItems[] = ['desc'=>$desc,'qty'=>$qty,'price'=>$price,'amount'=>$amount];
        }
        $taxAmount = round($subtotal * ($taxRate / 100), 2);
        $total     = round($subtotal + $taxAmount - $discount, 2);

        $pdo->beginTransaction();
        try {
            $pdo->prepare("
                UPDATE invoices SET client_id=?,issue_date=?,due_date=?,status=?,notes=?,
                    subtotal=?,tax_rate=?,tax_amount=?,discount=?,total=?
                WHERE id=? AND user_id=?
            ")->execute([$clientId,$issueDate,$dueDate,$status,$notes,$subtotal,$taxRate,$taxAmount,$discount,$total,$id,$userId]);

            $pdo->prepare("DELETE FROM invoice_items WHERE invoice_id=?")->execute([$id]);
            $ins = $pdo->prepare("INSERT INTO invoice_items (invoice_id,description,quantity,unit_price,amount) VALUES (?,?,?,?,?)");
            foreach ($newItems as $item) { $ins->execute([$id,$item['desc'],$item['qty'],$item['price'],$item['amount']]); }

            $pdo->commit();
            flash('success', 'Invoice updated.');
            redirect('/invoice-generator/preview_invoice.php?id=' . $id);
        } catch (Exception $e) {
            $pdo->rollBack();
            $errors[] = 'Could not update invoice. Please try again.';
        }
    }
}

$user     = getCurrentUser($pdo);
$currency = $user['currency_symbol'] ?? '$';
include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h2 class="page-title">Edit Invoice</h2>
        <p class="page-subtitle"><?= e($invoice['invoice_number']) ?></p>
    </div>
    <a href="/invoice-generator/preview_invoice.php?id=<?= $id ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<?php if ($errors): ?>
<div class="alert alert-danger">
    <?php foreach ($errors as $err): ?><p><?= e($err) ?></p><?php endforeach; ?>
    <button class="alert-close" onclick="this.parentElement.remove()">&times;</button>
</div>
<?php endif; ?>

<form method="POST" id="invoice-form">
    <div class="invoice-form-grid">
        <div>
            <div class="card mb-1">
                <div class="card-header"><h3 class="card-title">Invoice Details</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Client <span class="required">*</span></label>
                        <select name="client_id" class="form-control" required>
                            <option value="">— Select —</option>
                            <?php foreach ($clients as $cl): ?>
                            <option value="<?= $cl['id'] ?>" <?= $cl['id'] == $invoice['client_id'] ? 'selected':'' ?>>
                                <?= e($cl['name']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-row-2">
                        <div class="form-group">
                            <label class="form-label">Issue Date</label>
                            <input type="date" name="issue_date" class="form-control" value="<?= e($invoice['issue_date']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Due Date</label>
                            <input type="date" name="due_date" class="form-control" value="<?= e($invoice['due_date']) ?>" required>
                        </div>
                    </div>
                    <div class="form-row-2">
                        <div class="form-group">
                            <label class="form-label">Tax Rate (%)</label>
                            <input type="number" name="tax_rate" id="tax-rate" class="form-control" value="<?= e($invoice['tax_rate']) ?>" min="0" max="100" step="0.1">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Discount ($)</label>
                            <input type="number" name="discount" id="discount-input" class="form-control" value="<?= e($invoice['discount'] ?? 0) ?>" min="0" step="0.01">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <?php foreach (['draft','pending','sent','paid','overdue'] as $s): ?>
                            <option value="<?= $s ?>" <?= $invoice['status']===$s?'selected':'' ?>><?= ucfirst($s) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3"><?= e($invoice['notes']) ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Totals</h3>
                </div>
                <div class="card-body">
                    <div class="totals-box">
                        <div class="totals-row"><span>Subtotal</span><span id="disp-subtotal">$0.00</span></div>
                        <div class="totals-row"><span>Tax (<span id="disp-tax-rate">0</span>%)</span><span id="disp-tax">$0.00</span></div>
                        <div class="totals-row totals-total"><span>Total Due</span><span id="disp-total">$0.00</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Items Table -->
    <div class="card mb-1">
        <div class="card-header">
            <h3 class="card-title">Line Items</h3>
            <button type="button" class="btn btn-secondary btn-sm" id="add-item-btn"><i class="fas fa-plus"></i> Add Row</button>
        </div>
        <div class="card-body p-0">
            <div class="table-wrapper">
                <table class="table" id="items-table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th style="width:110px">Qty</th>
                            <th style="width:140px">Unit Price</th>
                            <th style="width:130px">Amount</th>
                            <th style="width:50px"></th>
                        </tr>
                    </thead>
                    <tbody id="items-body"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
    </div>
</form>

<script>
window.CURRENCY = '<?= addslashes($currency) ?>';
window.EXISTING_ITEMS = <?= json_encode(array_map(fn($i) => [
    'description' => $i['description'],
    'quantity'    => $i['quantity'],
    'unit_price'  => $i['unit_price'],
], $items), JSON_HEX_TAG) ?>;
</script>
<?php include 'includes/footer.php'; ?>
