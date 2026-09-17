<?php
// ─── Invoice Number Generator ─────────────────────────────────────────────────
function generateInvoiceNumber(PDO $pdo, int $userId): string {
    $year  = date('Y');
    $month = date('m');
    $stmt  = $pdo->prepare("SELECT COUNT(*) FROM invoices WHERE user_id = ? AND YEAR(created_at) = ?");
    $stmt->execute([$userId, $year]);
    $count = (int)$stmt->fetchColumn() + 1;
    return 'INV-' . $year . $month . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
}

// ─── Currency Formatter ───────────────────────────────────────────────────────
function formatMoney(float $amount, string $symbol = '#'): string {
    return $symbol . number_format($amount, 2);
}

// Alias used in preview/download pages
function formatCurrency(float $amount, string $symbol = '$'): string {
    return formatMoney($amount, $symbol);
}

// ─── Status Badge HTML ────────────────────────────────────────────────────────
function statusBadge(string $status): string {
    $map = [
        'draft'   => ['badge-secondary', 'Draft'],
        'pending' => ['badge-warning',   'Pending'],
        'sent'    => ['badge-info',      'Sent'],
        'paid'    => ['badge-success',   'Paid'],
        'overdue' => ['badge-danger',    'Overdue'],
    ];
    [$cls, $label] = $map[$status] ?? ['badge-secondary', ucfirst($status)];
    return "<span class='badge {$cls}'>{$label}</span>";
}

// ─── Flash Messages ───────────────────────────────────────────────────────────
function setFlash(string $message, string $type = 'success'): void {
    $_SESSION['flash'] = compact('message', 'type');
}

// Alias
function flash(string $type, string $message): void {
    setFlash($message, $type);
}

function flashMessage(): void {
    if (!empty($_SESSION['flash'])) {
        $f    = $_SESSION['flash'];
        $type = $f['type'] === 'error' ? 'danger' : $f['type'];
        unset($_SESSION['flash']);
        echo "<div class='alert alert-{$type}'>
                <span>" . htmlspecialchars($f['message']) . "</span>
                <button class='alert-close' onclick='this.parentElement.remove()'>&times;</button>
              </div>";
    }
}

// Alias
function showFlash(): void {
    flashMessage();
}

// ─── Safe Redirect ────────────────────────────────────────────────────────────
function redirect(string $url, string $message = '', string $type = 'success'): void {
    if ($message) setFlash($message, $type);
    header("Location: $url");
    exit;
}

// ─── Sanitise Input ───────────────────────────────────────────────────────────
function clean(string $val): string {
    return htmlspecialchars(strip_tags(trim($val)));
}

// HTML escape alias
function e($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

// ─── Date Formatting ─────────────────────────────────────────────────────────
function fmtDate(string $date): string {
    return date('M d, Y', strtotime($date));
}

// ─── Days Until Due ───────────────────────────────────────────────────────────
function daysUntilDue(string $dueDate): int {
    $due  = new DateTime($dueDate);
    $now  = new DateTime('today');
    $diff = $now->diff($due);
    return $diff->invert ? -$diff->days : $diff->days;
}

// ─── Current User ID ─────────────────────────────────────────────────────────
function currentUserId(): ?int {
    return isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;
}

// ─── Get Current User From DB ─────────────────────────────────────────────────
function getCurrentUser(PDO $pdo): array {
    if (!isset($_SESSION['user_id'])) return [];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
}