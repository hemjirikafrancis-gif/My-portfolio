<?php
require_once __DIR__ . '/../../auth.php';
include __DIR__ . '/../../db.php';
$id = (int)($_GET['id'] ?? 0);
$to = (int)($_GET['to'] ?? 0) === 1 ? 1 : 0;
if ($id > 0) {
  $stmt = $conn->prepare("UPDATE testimonials SET approved = ? WHERE id = ?");
  $stmt->bind_param('ii', $to, $id);
  $stmt->execute();
  $stmt->close();
}
$conn->close();
header('Location: index.php?' . ($to ? 'approved' : 'rejected') . '=1');
exit;
