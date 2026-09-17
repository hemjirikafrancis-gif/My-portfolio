<?php
require __DIR__ . '/auth.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: dashboard.php'); exit; }
csrf_check();

$id = (int)($_POST['id'] ?? 0);
if ($id) {
    $stmt = $pdo->prepare('DELETE FROM posts WHERE id = ?');
    $stmt->execute([$id]);
}
header('Location: dashboard.php?msg=' . urlencode('Post deleted.'));
exit;
