<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';
requireLogin();

$userId = currentUserId();
$id     = (int)($_POST['id'] ?? 0);

if ($id) {
    $stmt = $pdo->prepare("SELECT id FROM invoices WHERE id=? AND user_id=?");
    $stmt->execute([$id, $userId]);
    if ($stmt->fetch()) {
        $pdo->prepare("DELETE FROM invoice_items WHERE invoice_id=?")->execute([$id]);
        $pdo->prepare("DELETE FROM invoices WHERE id=? AND user_id=?")->execute([$id, $userId]);
        flash('success', 'Invoice deleted.');
    } else {
        flash('error', 'Invoice not found.');
    }
}
redirect('/invoice-generator/invoices.php');
