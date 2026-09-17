<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';
requireLogin();

$uid    = $_SESSION['user_id'];
$errors = [];

// Fetch clients for dropdown
$clientsStmt = $pdo->prepare("SELECT id, name FROM clients WHERE user_id = ? ORDER BY name");
$clientsStmt->execute([$uid]);
$clients = $clientsStmt->fetchAll();

// ── Handle Form Submission (POST) ─────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientId     = (int)($_POST['client_id'] ?? 0);
    $invoiceNum   = clean($_POST['invoice_number'] ?? '');
    $status       = $_POST['status'] ?? 'draft';
    $issueDate    = $_POST['issue_date'] ?? '';
    $dueDate      = $_POST['due_date']   ?? '';
    $notes        = clean($_POST['notes'] ?? '');
    $taxRate      = (float)($_POST['tax_rate'] ?? 0);
    $discount     = (float)($_POST['discount'] ?? 0);

    $descriptions = $_POST['description'] ?? [];
    $quantities   = $_POST['quantity']    ?? [];
    $unitPrices   = $_POST['unit_price']  ?? [];

    if (!$clientId)    $errors[] = 'Please select a client.';
    if (!$invoiceNum)  $errors[] = 'Invoice number is required.';
    if (!$issueDate)   $errors[] = 'Issue date is required.';
    if (!$dueDate)     $errors[] = 'Due date is required.';
    if (empty($descriptions) || !array_filter($descriptions)) $errors[] = 'Add at least one line item.';
    if (!in_array($status, ['draft','pending','paid','overdue'])) $status = 'draft';

    if (empty($errors)) {
        $subtotal = 0;
        $items = [];
        foreach ($descriptions as $i => $desc) {
            $desc  = trim($desc);
            if (!$desc) continue;
            $qty   = (float)($quantities[$i]  ?? 1);
            $price = (float)($unitPrices[$i]  ?? 0);
            $line  = round($qty * $price, 2);
            $subtotal += $line;
            $items[]  = compact('desc', 'qty', 'price', 'line');
        }
        $taxAmount = round($subtotal * ($taxRate / 100), 2);
        $total     = round($subtotal + $taxAmount - $discount, 2);

        $ins = $pdo->prepare("
            INSERT INTO invoices
                (user_id, client_id, invoice_number, status, issue_date, due_date,
                 notes, subtotal, tax_rate, tax_amount, discount, total)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?)
        ");
        $ins->execute([$uid, $clientId, $invoiceNum, $status, $issueDate, $dueDate,
                       $notes, $subtotal, $taxRate, $taxAmount, $discount, $total]);
        $invoiceId = $pdo->lastInsertId();

        $itemIns = $pdo->prepare("INSERT INTO invoice_items (invoice_id, description, quantity, unit_price, amount) VALUES (?,?,?,?,?)");
        foreach ($items as $it) {
            $itemIns->execute([$invoiceId, $it['desc'], $it['qty'], $it['price'], $it['line']]);
        }

        redirect('/invoice-generator/preview_invoice.php?id=' . $invoiceId, 'Invoice created successfully!');
    }
}

$defaultNum  = generateInvoiceNumber($pdo, $uid);
$defaultDate = date('Y-m-d');
$defaultDue  = date('Y-m-d', strtotime('+30 days'));

$pageTitle = 'Create Invoice';
include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h2 class="page-title">New Invoice</h2>
        <p class="page-subtitle">Fill in the details below</p>
    </div>
    <a href="/invoice-generator/invoices.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<?php if (!empty($errors)): ?>
<div class="alert alert-danger">
    <?php foreach ($errors as $err): ?><p><?= htmlspecialchars($err) ?></p><?php endforeach; ?>
    <button class="alert-close" onclick="this.parentElement.remove()">&times;</button>
</div>
<?php endif; ?>

<?php if (empty($clients)): ?>
<div class="alert alert-warning">
    You have no clients yet. <a href="/invoice-generator/clients.php">Add a client first</a> before creating an invoice.
</div>
<?php else: ?>

<form method="POST" id="invoice-form">
    <div class="invoice-form-grid">

        <!-- Left Column -->
        <div>
            <div class="card mb-1">
                <div class="card-header"><h3 class="card-title">Invoice Details</h3></div>
                <div class="card-body">
                    <div class="form-row-2">
                        <div class="form-group">
                            <label class="form-label">Invoice Number <span class="required">*</span></label>
                            <input type="text" name="invoice_number" class="form-control"
                                   value="<?= htmlspecialchars($_POST['invoice_number'] ?? $defaultNum) ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <?php foreach (['draft','pending','paid','overdue'] as $s): ?>
                                <option value="<?= $s ?>" <?= ($_POST['status'] ?? 'draft') === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row-2">
                        <div class="form-group">
                            <label class="form-label">Issue Date <span class="required">*</span></label>
                            <input type="date" name="issue_date" class="form-control"
                                   value="<?= htmlspecialchars($_POST['issue_date'] ?? $defaultDate) ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Due Date <span class="required">*</span></label>
                            <input type="date" name="due_date" class="form-control"
                                   value="<?= htmlspecialchars($_POST['due_date'] ?? $defaultDue) ?>" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-1">
                <div class="card-header"><h3 class="card-title">Bill To</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Select Client <span class="required">*</span></label>
                        <select name="client_id" class="form-control" required>
                            <option value="">— Choose a client —</option>
                            <?php foreach ($clients as $c): ?>
                            <option value="<?= $c['id'] ?>" <?= ($_POST['client_id'] ?? '') == $c['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($c['name']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <a href="/invoice-generator/clients.php" class="btn btn-secondary btn-sm"><i class="fas fa-plus"></i> Add New Client</a>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div>
            <div class="card mb-1">
                <div class="card-header"><h3 class="card-title">Notes</h3></div>
                <div class="card-body">
                    <textarea name="notes" class="form-control" rows="4"
                              placeholder="Payment terms, thank-you note, etc..."><?= htmlspecialchars($_POST['notes'] ?? '') ?></textarea>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h3 class="card-title">Totals</h3></div>
                <div class="card-body">
                    <div class="form-row-2">
                        <div class="form-group">
                            <label class="form-label">Tax Rate (%)</label>
                            <input type="number" name="tax_rate" id="tax-rate" class="form-control"
                                   min="0" max="100" step="0.01" value="<?= htmlspecialchars($_POST['tax_rate'] ?? '0') ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Discount ($)</label>
                            <input type="number" name="discount" id="discount-input" class="form-control"
                                   min="0" step="0.01" value="<?= htmlspecialchars($_POST['discount'] ?? '0') ?>">
                        </div>
                    </div>
                    <div class="totals-box">
                        <div class="totals-row"><span>Subtotal</span><span id="disp-subtotal">$0.00</span></div>
                        <div class="totals-row"><span>Tax (<span id="disp-tax-rate">0</span>%)</span><span id="disp-tax">$0.00</span></div>
                        <div class="totals-row"><span>Discount</span><span id="disp-discount">$0.00</span></div>
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
            <button type="button" class="btn btn-secondary btn-sm" id="add-item-btn">
                <i class="fas fa-plus"></i> Add Row
            </button>
        </div>
        <div class="card-body p-0">
            <div class="table-wrapper">
                <table class="table" id="items-table">
                    <thead>
                        <tr>
                            <th>Description <span class="required">*</span></th>
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
        <button type="submit" class="btn btn-secondary">
            <i class="fas fa-save"></i> Save as Draft
        </button>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-eye"></i> Save &amp; Preview
        </button>
    </div>
</form>
<?php endif; ?>

<script>
window.CURRENCY = '<?= addslashes($user['currency_symbol'] ?? '$') ?>';
window.EXISTING_ITEMS = [];
</script>
<?php include 'includes/footer.php'; ?>
